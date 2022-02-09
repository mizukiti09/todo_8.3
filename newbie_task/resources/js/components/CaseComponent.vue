<template>
  <div>
    <div
      class="task-one"
      v-for="(data, i) in cases"
      :key="'task' + i"
      v-show="show"
    >
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" :id="'heading' + i">
            <button
              class="accordion-button"
              type="button"
              data-bs-toggle="collapse"
              :data-bs-target="'#collapse' + i"
              aria-expanded="true"
              :aria-controls="'collapse' + i"
              v-on:click="imgShow(data.task_id)"
            >
              <span style="width: 90%; overflow: scroll; text-align: left;">
                {{ data.task_name }} <span v-if="urlPathName.includes('result')" class="dayTime badge rounded-pill bg-info text-dark">{{data.dayTime}}</span>
                <span class="dayTime badge rounded-pill bg-secondary">{{data.user_name}}</span>
              </span>
            </button>
          </h2>
          <div
            :id="'collapse' + i"
            class="accordion-collapse collapse"
            :aria-labelledby="'heading' + i"
            data-bs-parent="#accordionExample"
          >
            <div class="accordion-body">
              <!-- =========================================================== -->
              <!-- =============== 自分の案件内容 =======================-->
              <!-- =========================================================== -->
              <div class="task-body" v-if="urlPathName.includes('myTasks')">
                <div class="card">
                  <!-- タスクネーム -->

                  <span class="task-error" v-if="err_task_name">
                    {{ err_task_name }}
                  </span>
                  <h6
                    class="card-header task-body-header"
                    v-if="!arrayChecker[i].task_name"
                    v-on:click="doEditTask(i, 'task_name')"
                  >
                    タスク名：{{ data.task_name }}
                  </h6>
                  <input
                    v-else
                    type="text"
                    class="form-control"
                    v-model="data.task_name"
                    v-on:blur="
                      arrayChecker[i].task_name = false
                      editDB(data.task_id, data.task_name, 'task_name')
                    "
                    v-focus
                  />

                  <!-- タスク内容 -->
                  <span class="task-error" v-if="err_task_body">
                    {{ err_task_body }}
                  </span>
                  <div
                    class="card-body task-body-body"
                    v-if="!arrayChecker[i].task_body"
                    v-on:click="doEditTask(i, 'task_body')"
                  >
                    <p class="card-text">{{ data.task_body }}</p>
                  </div>
                  <textarea
                    class="task-body-body-textarea"
                    id="js-task-body"
                    v-else
                    v-model="data.task_body"
                    v-on:blur="
                      arrayChecker[i].task_body = false
                      editDB(data.task_id, data.task_body, 'task_body')
                    "
                    v-focus
                  ></textarea>

                  <!--========= タスクimgリスト ====================== -->

                  <div class="card img-list" v-if="imgList == true">
                    <li class="list-group-item">
                      img変更⬇️ &nbsp;&nbsp;

                      <span
                        v-bind:class="{ imgChangeText1: img1 }"
                        class="img-change"
                        v-on:click="showInputFile('img1')"
                      >
                        img1
                      </span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span
                        v-bind:class="{ imgChangeText2: img2 }"
                        class="img-change"
                        v-on:click="showInputFile('img2')"
                      >
                        img2
                      </span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span
                        v-bind:class="{ imgChangeText3: img3 }"
                        class="img-change"
                        v-on:click="showInputFile('img3')"
                      >
                        img3
                      </span>
                    </li>
                    <div class="mt-3" v-if="img1">
                      <span
                        class="task-error"
                        v-if="file_errors1 && !edit_task_img1"
                      >
                        {{ file_errors1 }}
                      </span>
                      <label for="formFileSm" class="form-label">
                        img1
                      </label>
                      <input
                        class="form-control form-control-sm"
                        id="formFileSm"
                        type="file"
                        name="edit_task_img1"
                        @change="onImageUploaded"
                        multiple
                      />
                    </div>
                    <div class="mt-3" v-if="img2">
                      <span
                        class="task-error"
                        v-if="file_errors2 && !edit_task_img2"
                      >
                        {{ file_errors2 }}
                      </span>
                      <label for="formFileSm" class="form-label">
                        img2
                      </label>
                      <input
                        class="form-control form-control-sm"
                        id="formFileSm"
                        type="file"
                        name="edit_task_img2"
                        @change="onImageUploaded"
                        multiple
                      />
                    </div>
                    <div class="mt-3" v-if="img3">
                      <span
                        class="task-error"
                        v-if="file_errors3 && !edit_task_img3"
                      >
                        {{ file_errors3 }}
                      </span>
                      <label for="formFileSm" class="form-label">
                        img3
                      </label>
                      <input
                        class="form-control form-control-sm"
                        id="formFileSm"
                        type="file"
                        name="edit_task_img3"
                        @change="onImageUploaded"
                        multiple
                      />
                    </div>
                    <input
                      v-if="img1 || img2 || img3"
                      class="btn btn-primary"
                      type="submit"
                      value="img変更"
                      v-on:click="editTaskImgDB(data.task_id)"
                    />
                  </div>
                </div>

                <!-- ================ アイコン img と ゴミ箱 ======================= -->
                <div class="case-icon-container">
                  <i
                    class="far fa-image case-icon case-icon-img"
                    v-on:click="imgListOpen()"
                  ></i>
                  <i
                    class="fas fa-trash-alt case-icon"
                    data-bs-toggle="modal"
                    :data-bs-target="'#deleteTask' + data.task_id"
                  ></i>
                </div>

                <div
                  class="modal fade"
                  :id="'deleteTask' + data.task_id"
                  tabindex="-1"
                  aria-labelledby="deleteTaskLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteTaskLabel">
                          削除：{{ data.task_name }}
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>

                      <div class="modal-body">
                        こちらのタスクを削除しますか？
                      </div>

                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-dismiss="modal"
                        >
                          いいえ
                        </button>
                        <button
                          type="submit"
                          class="btn"
                          style="background: skyblue;"
                          v-on:click="deleteDB(data.task_id)"
                        >
                          はい
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ================  state変更ボタン ===================== -->
                <button
                  type="button"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  :data-bs-target="'#exampleModal' + data.task_id"
                  v-if="(urlPathName === '/myTasks') || (urlPathName === '/group_myTasks')"
                >
                  {{ stateChangeText }}
                </button>
                <div
                  class="modal fade"
                  :id="'exampleModal' + data.task_id"
                  tabindex="-1"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="data.state_id == 3">
                          {{ stateChangeText }}：{{ data.task_name }}
                        </h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-else>
                          {{ stateChangeText }}に変更：{{ data.task_name }}
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>

                      <div class="modal-body">
                        実行しますか？
                      </div>

                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-dismiss="modal"
                        >
                          いいえ
                        </button>
                        
                        <button
                          type="submit"
                          class="btn"
                          style="background: skyblue;"
                          v-on:click="changeState(data.task_id, data.state_id)"
                        >
                          はい
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- =========================================================== -->
              <!-- =============== 自分以外の案件内容 =======================-->
              <!-- =========================================================== -->
              <div class="task-body" style="white-space: pre-line;" v-else>
                {{ data.task_body }}
              </div>
              <!-- =========================================================== -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: ['cases', 'auth_user_id', 'stateChangeText', 'group_id'],
  data() {
    return {
      imgList: false,
      img1: false,
      img2: false,
      img3: false,
      show: true,
      urlPathName: location.pathname,
      arrayChecker: '',
      add_task_name: '',
      add_task_body: '',
      edit_task_img1: '',
      edit_task_img2: '',
      edit_task_img3: '',
      err_task_name: '',
      err_task_body: '',
      file_errors1: '',
      file_errors2: '',
      file_errors3: '',
    }
  },
  created() {
    var vm = this
    //チェック用の配列を作る
    vm.arrayChecker = _.cloneDeepWith(vm.cases, function (val) {
      if (!_.isObject(val)) {
        return false
      }
    })
  },
  directives: {
    focus: {
      // ディレクティブ定義
      inserted: function (el) {
        el.focus()
      },
    },
  },
  methods: {
    changeState: function (task_id, state_id) {
      console.log('この案件のIDは：' + task_id)
      console.log('この案件の状態のIDは：' + state_id)

      

        this.$axios
          .post('/api/myTasks/changeState', {
            task_id: task_id,
          })
          .then((res) => {
            console.log('案件をの状態を変更。')
            console.log(res['data'])
            window.location.reload()
          })
          .catch((error) => {
            console.log('changeStateは正常に起動していません。')
            console.log(error)
          })
    },
    showInputFile: function (img) {
      if (img == 'img1' && this.img1 == false) {
        this.img1 = true
      } else if (img == 'img1' && this.img1 == true) {
        this.img1 = false
      }

      if (img == 'img2' && this.img2 == false) {
        this.img2 = true
      } else if (img == 'img2' && this.img2 == true) {
        this.img2 = false
      }

      if (img == 'img3' && this.img3 == false) {
        this.img3 = true
      } else if (img == 'img3' && this.img3 == true) {
        this.img3 = false
      }
    },
    imgListOpen: function () {
      if (this.imgList == false) {
        this.imgList = true
      } else {
        this.imgList = false
      }
    },
    doEditTask: function (index, key) {
      this.arrayChecker[index][key] = true
    },
    editDB: function (task_id, task_val, task_column) {
      if (task_val == '') {
        if (task_column == 'task_name') {
          this.err_task_name = 'タスク名は必須です'
        } else if (task_column == 'task_body') {
          this.err_task_body = 'タスク内容は必須です'
        }
      } else {
        if (task_column == 'task_name') {
          this.err_task_name = ''
        } else if (task_column == 'task_body') {
          this.err_task_body = ''
        }

        this.$axios
          .post('/api/myTasks/edit', {
            id: task_id,
            column: task_column,
            val: task_val,
          })
          .then((res) => {
            console.log('タスクID :' + task_id + 'のデータを変更しました。')
          })
          .catch((error) => {
            console.log('editDBは正常に起動していません。')
            console.log(error)
          })
      }
    },
    deleteDB: function (task_id) {
      this.$axios
        .post('/api/myTasks/delete', {
          id: task_id,
        })
        .then((res) => {
          console.log('タスクID :' + task_id + 'のデータを削除しました。')
          window.location.reload()
        })
        .catch((error) => {
          console.log('deleteDBは正常に起動していません。')
          console.log(error)
        })
    },
    imgShow: function (task_id){
      

      console.log('imgShowのTaskのIDは' + task_id)
      this.$axios
        .post('/api/imgShow', {
          task_id: task_id,
        })
        .then((res) => {
          console.log(res['data'])
          this.$parent.target_taskImages = res['data']
        })
        .catch((error) => {
          console.log(res['data'])
          console.log('imgShowは正常に起動していません。')
          console.log(error)
        })
    },
    onImageUploaded: function (e) {
      console.log(e.target['name'])
      var targetName = e.target['name']

      var file = e.target.files[0],
        file_name = file.name,
        size = file.size,
        type = file.type,
        errFileSize = 'ファイルの上限サイズ256MBを超えています',
        errFileType =
          '.jpg、.gif、.png、.pdfのいずれかのファイルのみ許可されています\n',
        err_flg = false

      //上限サイズは256MB
      if (size > 2560000000) {
        if (targetName == 'edit_task_img1') {
          this.file_errors1 = errFileSize
        } else if (targetName == 'edit_task_img2') {
          this.file_errors2 = errFileSize
        } else if (targetName == 'edit_task_img3') {
          this.file_errors3 = errFileSize
        }
        err_flg = true
        return
      } else {
        //拡張子は .jpg .gif .png のみ許可
        if (
          type != 'image/jpeg' &&
          type != 'image/gif' &&
          type != 'image/png'
        ) {
          if (targetName == 'edit_task_img1') {
            this.edit_task_img1 = ''
            this.file_errors1 = errFileType
          } else if (targetName == 'edit_task_img2') {
            this.edit_task_img2 = ''
            this.file_errors2 = errFileType
          } else if (targetName == 'edit_task_img3') {
            this.edit_task_img3 = ''
            this.file_errors3 = errFileType
          }
          err_flg = true
          return
        } else {
          if (err_flg == false) {
            if (targetName == 'edit_task_img1') {
              this.edit_task_img1 = file
              this.file_errors1 = ''
              console.log(this.edit_task_img1)
            } else if (targetName == 'edit_task_img2') {
              this.edit_task_img2 = file
              this.file_errors2 = ''
              console.log(this.edit_task_img2)
            } else if (targetName == 'edit_task_img3') {
              this.edit_task_img3 = file
              this.file_errors3 = ''
              console.log(this.edit_task_img3)
            }
          }
        }
      }
    },
    editTaskImgDB: function (task_id) {
      // タスク名、タスク内容バリデーション

      if (!this.file_errors1 && !this.file_errors2 && !this.file_errors3) {
        console.log('バリデーションOK')

        if (this.img1 || this.img2 || this.img3) {
          // formDataオブジェクトとaxiosを利用してファイルのアップロードを行う。
          const formData = new FormData()

          formData.append('task_id', task_id)
          if (this.edit_task_img1 && this.img1) {
            formData.append('task_img1', this.edit_task_img1)
          } else if (!this.edit_task_img1 && this.img1) {
            formData.append('task_img1', 'null')
          }
          if (this.edit_task_img2 && this.img2) {
            formData.append('task_img2', this.edit_task_img2)
          }else if (!this.edit_task_img2 && this.img2) {
            formData.append('task_img2', 'null')
          }
          if (this.edit_task_img3 && this.img3) {
            formData.append('task_img3', this.edit_task_img3)
          } else if (!this.edit_task_img3 && this.img3) {
            formData.append('task_img3', 'null')
          }

          
          // 一つ一つ値を取得
          // console.log(formData.get('task_img1'))
          // console.log(formData.get('task_img2'))
          // console.log(formData.get('task_img3'))

          // forを使って値を取得
          for (let value of formData.entries()) {
            console.log(value)
          }

          this.$axios
            .post('/api/myTasks/editTaskImg', formData)
            .then((res) => {
              console.log(res)
              window.location.reload()
            })
            .catch((error) => {
              console.log('editTaskImgDBは正常に起動していません。')
              console.log(error)
            })
        }
      } else {
        console.log('バリデーションに掛かっています')
      }
    },
  },
}
</script>
