/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/***/ (() => {

eval("$(function () {\n  // ハンバーガーmenu\n  $('.hamburger').click(function () {\n    $(this).toggleClass('active');\n\n    if ($(this).hasClass('active')) {\n      $('.globalMenuSp').addClass('active');\n    } else {\n      $('.globalMenuSp').removeClass('active');\n    }\n  });\n});\n$(function () {\n  $('#js-task-body').on('input', function () {\n    if ($(this).outerHeight() > this.scrollHeight) {\n      $(this).height(1);\n    }\n\n    while ($(this).outerHeight() < this.scrollHeight) {\n      $(this).height($(this).height() + 1);\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc2NyaXB0LmpzP2M2M2IiXSwibmFtZXMiOlsiJCIsImNsaWNrIiwidG9nZ2xlQ2xhc3MiLCJoYXNDbGFzcyIsImFkZENsYXNzIiwicmVtb3ZlQ2xhc3MiLCJvbiIsIm91dGVySGVpZ2h0Iiwic2Nyb2xsSGVpZ2h0IiwiaGVpZ2h0Il0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDLFlBQVc7QUFFVDtBQUNBQSxFQUFBQSxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCQyxLQUFoQixDQUFzQixZQUFXO0FBQzdCRCxJQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFFLFdBQVIsQ0FBb0IsUUFBcEI7O0FBRUEsUUFBSUYsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRRyxRQUFSLENBQWlCLFFBQWpCLENBQUosRUFBZ0M7QUFDNUJILE1BQUFBLENBQUMsQ0FBQyxlQUFELENBQUQsQ0FBbUJJLFFBQW5CLENBQTRCLFFBQTVCO0FBQ0gsS0FGRCxNQUVPO0FBQ0hKLE1BQUFBLENBQUMsQ0FBQyxlQUFELENBQUQsQ0FBbUJLLFdBQW5CLENBQStCLFFBQS9CO0FBQ0g7QUFDSixHQVJEO0FBVUgsQ0FiQSxDQUFEO0FBY0FMLENBQUMsQ0FBQyxZQUFXO0FBQ1RBLEVBQUFBLENBQUMsQ0FBQyxlQUFELENBQUQsQ0FDS00sRUFETCxDQUNRLE9BRFIsRUFDaUIsWUFBVztBQUNwQixRQUFJTixDQUFDLENBQUMsSUFBRCxDQUFELENBQVFPLFdBQVIsS0FBd0IsS0FBS0MsWUFBakMsRUFBK0M7QUFDM0NSLE1BQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUVMsTUFBUixDQUFlLENBQWY7QUFDSDs7QUFDRCxXQUFPVCxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFPLFdBQVIsS0FBd0IsS0FBS0MsWUFBcEMsRUFBa0Q7QUFDOUNSLE1BQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUVMsTUFBUixDQUFlVCxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFTLE1BQVIsS0FBbUIsQ0FBbEM7QUFDSDtBQUNKLEdBUkw7QUFTSCxDQVZBLENBQUQiLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uKCkge1xuXG4gICAgLy8g44OP44Oz44OQ44O844Ks44O8bWVudVxuICAgICQoJy5oYW1idXJnZXInKS5jbGljayhmdW5jdGlvbigpIHtcbiAgICAgICAgJCh0aGlzKS50b2dnbGVDbGFzcygnYWN0aXZlJyk7XG5cbiAgICAgICAgaWYgKCQodGhpcykuaGFzQ2xhc3MoJ2FjdGl2ZScpKSB7XG4gICAgICAgICAgICAkKCcuZ2xvYmFsTWVudVNwJykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCgnLmdsb2JhbE1lbnVTcCcpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgfVxuICAgIH0pO1xuXG59KTtcbiQoZnVuY3Rpb24oKSB7XG4gICAgJCgnI2pzLXRhc2stYm9keScpXG4gICAgICAgIC5vbignaW5wdXQnLCBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGlmICgkKHRoaXMpLm91dGVySGVpZ2h0KCkgPiB0aGlzLnNjcm9sbEhlaWdodCkge1xuICAgICAgICAgICAgICAgICQodGhpcykuaGVpZ2h0KDEpXG4gICAgICAgICAgICB9XG4gICAgICAgICAgICB3aGlsZSAoJCh0aGlzKS5vdXRlckhlaWdodCgpIDwgdGhpcy5zY3JvbGxIZWlnaHQpIHtcbiAgICAgICAgICAgICAgICAkKHRoaXMpLmhlaWdodCgkKHRoaXMpLmhlaWdodCgpICsgMSlcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG59KTsiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3NjcmlwdC5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/script.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/script.js"]();
/******/ 	
/******/ })()
;