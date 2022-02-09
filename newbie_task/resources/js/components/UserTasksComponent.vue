<template>
  <div>
    
    <Slick
      ref="slick"
      :options="slickOptions"
      class="slick-outer"
      style="width: 100%; height: 40vh; background: currentColor;"
      v-if="(target_taskImages !== 0) && urlPathName.includes('myTasks')"
    >
        <!-- img1 -->
        <div class="slick-cont-img" v-if="target_taskImages.img1">
          <img :src="target_taskImages.img1" class="slick-img"  />
        </div>
        <div class="slick-cont-img" v-else>
          <img :src="img_no_Path" class="slick-img" />
        </div>
        <!-- img2 -->
        <div class="slick-cont-img" v-if="target_taskImages.img2">
          <img :src="target_taskImages.img2" class="slick-img" />
        </div>
        <div class="slick-cont-img" v-else>
          <img :src="img_no_Path" class="slick-img" />
        </div>
        <!-- img3 -->
        <div class="slick-cont-img" v-if="target_taskImages.img3">
          <img :src="target_taskImages.img3" class="slick-img" />
        </div>
        <div class="slick-cont-img" v-else>
          <img :src="img_no_Path" class="slick-img" />
        </div>
      </Slick>
      <Slick
      ref="slick"
      :options="slickOptions"
      class="slick-outer"
      style="width: 100%; height: 40vh; background: currentColor;"
      v-else
    >
        <!-- img1 -->
        <div class="slick-cont-img" v-if="target_taskImages.img1">
          <img :src="urlHead + target_taskImages.img1" class="slick-img"  />
        </div>
        <div class="slick-cont-img" v-else>
          <img :src="urlHead + img_no_Path" class="slick-img" />
        </div>
        <!-- img2 -->
        <div class="slick-cont-img" v-if="target_taskImages.img2">
          <img :src="urlHead + target_taskImages.img2" class="slick-img" />
        </div>
        <div class="slick-cont-img" v-else>
          <img :src="urlHead + img_no_Path" class="slick-img" />
        </div>
        <!-- img3 -->
        <div class="slick-cont-img" v-if="target_taskImages.img3">
          <img :src="urlHead + target_taskImages.img3" class="slick-img" />
        </div>
        <div class="slick-cont-img" v-else>
          <img :src="urlHead + img_no_Path" class="slick-img" />
        </div>
      
    </Slick>

    <div class="row" v-if="urlPathName.includes('Tasks')">
      <div class="col-sm-12 case-header">
        <!-- タスク追加アイコン -->
        <i
          class="fas fa-plus task-icon task-icon-add"
          v-if="addTaskField == false && ((urlPathName == '/myTasks') || (urlPathName == '/group_myTasks'))"
          v-on:click="addTaskOpen()"
        ></i>
        <i
          class="fas fa-times task-icon-delete"
          v-if="addTaskField == true"
          v-on:click="addTaskClose()"
        ></i>

        <div class="col-4 case-state bg-dark">
          <h2 class="accordion-header case-state-header" id="flush-headingOne" >
            <button
            style="height:100%;"
              class="accordion-button collapsed case-state-button case-state-not"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseOne"
              aria-expanded="false"
              aria-controls="flush-collapseOne"
            >
              First
            </button>
          </h2>
        </div>
        <div class="col-4 case-state bg-dark">
          <h2 class="accordion-header case-state-header" id="flush-headingTwo">
            <button
              class="accordion-button collapsed case-state-button case-state-decided"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseTwo"
              aria-expanded="false"
              aria-controls="flush-collapseTwo"
            >
              Second
            </button>
          </h2>
        </div>
        <div class="col-4 case-state bg-dark">
          <h2 class="accordion-header case-state-header" id="flush-headingThree">
            <button
              class="accordion-button collapsed case-state-button case-state-done"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseThree"
              aria-expanded="false"
              aria-controls="flush-collapseThree"
            >
              Done
            </button>
          </h2>
        </div>
      </div>

      <div class="task-addField" v-if="addTaskField == true">
        <form
          @submit.prevent
          method="post"
          enctype="multipart/form-data"
          action=""
        >
          <div class="mb-3">
            <span class="task-error" v-if="err_task_name">
              {{ err_task_name }}
            </span>
            <label for="task_name">
              <span class="required">*</span>
              タスク名
            </label>
            <input
              name="task_name"
              type="text"
              class="form-control"
              v-model="add_task_name"
            />
          </div>
          <div class="mb-3">
            <span class="task-error" v-if="err_task_body">
              {{ err_task_body }}
            </span>
            <label for="exampleFormControlTextarea1" class="form-label">
              <span class="required">*</span>
              タスク内容
            </label>
            <textarea
              name="task_body"
              class="form-control"
              id="exampleFormControlTextarea1"
              rows="3"
              v-model="add_task_body"
            ></textarea>
          </div>
          <div class="mb-3">
            <span class="task-error" v-if="file_errors1 && !add_task_img1">
              {{ file_errors1 }}
            </span>
            <label for="formFileSm" class="form-label">
              タスク補足img1
            </label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>※imgは最大3つまで</span>
            <input
              class="form-control form-control-sm"
              id="formFileSm"
              type="file"
              name="add_task_img1"
              @change="onImageUploaded"
              multiple
            />
          </div>
          <div class="mb-3" v-if="add_task_img1 && !file_errors1">
            <span class="task-error" v-if="file_errors2 && !add_task_img2">
              {{ file_errors2 }}
            </span>
            <label for="formFileSm" class="form-label">
              タスク補足img2
            </label>
            <input
              class="form-control form-control-sm"
              id="formFileSm"
              type="file"
              name="add_task_img2"
              @change="onImageUploaded"
              multiple
            />
          </div>
          <div class="mb-3" v-if="add_task_img2 && !file_errors2">
            <span class="task-error" v-if="file_errors3 && !add_task_img3">
              {{ file_errors3 }}
            </span>
            <label for="formFileSm" class="form-label">
              タスク補足img3
            </label>
            <input
              class="form-control form-control-sm"
              id="formFileSm"
              type="file"
              name="add_task_img3"
              @change="onImageUploaded"
              multiple
            />
          </div>

          <input
            class="btn btn-primary"
            type="submit"
            value="追加"
            v-on:click="addTaskDB()"
          />
        </form>
      </div>

      <div
        id="flush-collapseOne"
        class="accordion-collapse collapse"
        aria-labelledby="flush-headingOne"
        data-bs-parent="#accordionFlushExample"
      >
        <div class="accordion-body case-state-info">
          <Case
            :cases="not_decided"
            :auth_user_id="auth_user_id"
            :group_id="group_id"
            :stateChangeText="'Second'"
          />
        </div>
      </div>

      <div
        id="flush-collapseTwo"
        class="accordion-collapse collapse"
        aria-labelledby="flush-headingTwo"
        data-bs-parent="#accordionFlushExample"
      >
        <div class="accordion-body case-state-info">
          <Case
            :cases="decided"
            :auth_user_id="auth_user_id"
            :group_id="group_id"
            :stateChangeText="'Done'"
          />
        </div>
      </div>

      <div
        id="flush-collapseThree"
        class="accordion-collapse collapse"
        aria-labelledby="flush-headingOne"
        data-bs-parent="#accordionFlushExample"
      >
        <div class="accordion-body case-state-info">
          <Case
            :cases="done"
            :auth_user_id="auth_user_id"
            :group_id="group_id"
            :stateChangeText="'Result Up'"
          />
        </div>
      </div>
    </div>

<!-- /result/yearMonth -->
    <div class="row" v-if="urlPathName.includes('result')">
      <div class="accordion-body case-state-info">
          <Case
            :cases="results"
          />
        </div>
    </div>
    <!-- ==================== -->

  </div>
</template>
<script>
import Slick from 'vue-slick'
import Case from '../components/CaseComponent.vue'
import pdf from 'vue-pdf'

export default {
  props: ['not_decided', 'decided', 'done', 'auth_user_id', 'group_id', 'results', 'yearMonth'],
  data: function () {
    return {
      filePdf: '',
      target_taskImages: 0,
      img_no_Path: 'images/no_img.png',
      urlPathName: location.pathname,
      urlHead: location.protocol + '//' + location.host + '/',
      addTaskField: false,
      add_task_name: '',
      add_task_body: '',
      add_task_img1: '',
      add_task_img2: '',
      add_task_img3: '',
      err_task_name: '',
      err_task_body: '',
      file_errors1: '',
      file_errors2: '',
      file_errors3: '',
      slickOptions: {
        arrows: true, //スライドの矢印ボタン
        dots: false, //ドットマーク
        autoplay: false, //自動スライド
        autoplaySpeed: 4000, //自動スライド間隔(ms)
        pauseOnFocus: false, //ドットマークを押すとスライドショーが止まるのを防ぐ
        prevArrow: '<button type="button" class="slick-prev"></button>', //ひとつ前の画像に戻る矢印ボタン
        nextArrow: '<button type="button" class="slick-next"></button>', //ひとつ先の画像に進む矢印ボタン
      },
    }
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
    addTaskOpen: function () {
      this.addTaskField = true
    },
    addTaskClose: function () {
      this.addTaskField = false
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

        if (targetName == 'add_task_img1') {
          this.file_errors1 = errFileSize

        } else if (targetName == 'add_task_img2') {
          this.file_errors2 = errFileSize

        } else if (targetName == 'add_task_img3') {
          this.file_errors3 = errFileSize
        }
        err_flg = true
        return;
      } else {
        //拡張子は .jpg .gif .pngのみ許可
        if (
          type != 'image/jpeg' &&
          type != 'image/gif' &&
          type != 'image/png'
        ) {
          if (targetName == 'add_task_img1') {
            this.add_task_img1 = ''
            this.file_errors1 = errFileType
          } else if (targetName == 'add_task_img2') {
            this.add_task_img2 = ''
            this.file_errors2 = errFileType
          } else if (targetName == 'add_task_img3') {
            this.add_task_img3 = ''
            this.file_errors3 = errFileType
          }
          err_flg = true
          return;
        } else {
          if (err_flg == false) {
            if (targetName == 'add_task_img1') {
              this.add_task_img1 = file
              this.file_errors1 = ''
              console.log(this.add_task_img1)
            } else if (targetName == 'add_task_img2') {
              this.add_task_img2 = file
              this.file_errors2 = ''
              console.log(this.add_task_img2)
            } else if (targetName == 'add_task_img3') {
              this.add_task_img3 = file
              this.file_errors3 = ''
              console.log(this.add_task_img3)
            }
          }
        }
      }
    },
    addTaskDB: function () {
      // タスク名、タスク内容バリデーション
      this.err_task_name = ''
      this.err_task_body = ''
      if (!this.add_task_name) {
        this.err_task_name = 'タスク名は必須です。'
      } else {
        this.err_task_name = ''
      }
      if (!this.add_task_body) {
        this.err_task_body = 'タスク内容は必須です。'
      } else {
        this.err_task_body = ''
      }

      if (!this.err_task_name && !this.err_task_body && !this.file_errors1 && !this.file_errors2 && !this.file_errors3) {
        console.log('バリデーションOK')

        // formDataオブジェクトとaxiosを利用してファイルのアップロードを行う。
        const formData = new FormData()

        formData.append('user_id', this.auth_user_id)
        formData.append('group_id', this.group_id)
        formData.append('task_name', this.add_task_name)
        formData.append('task_body', this.add_task_body)
        formData.append('task_img1', this.add_task_img1)
        formData.append('task_img2', this.add_task_img2)
        formData.append('task_img3', this.add_task_img3)

        // 一つ一つ値を取得
        // console.log(formData.get('task_name'))
        // console.log(formData.get('task_body'))
        // console.log(formData.get('task_img1'))
        // console.log(formData.get('task_img2'))
        // console.log(formData.get('task_img3'))

        // forを使って値を取得
        for (let value of formData.entries()) { 
            console.log(value); 
        }


        this.$axios.post('/api/myTasks/create', formData)
        .then((res) => {
          console.log(res)
          window.location.reload()
        })
        .catch((error) => {
          console.log('addTaskDBは正常に起動していません。')
          console.log(error)
        })

      } else {
        console.log('バリデーションに掛かっています')
      }
    },

  },
  components: {
    Slick,
    Case,
  },
}
</script>
