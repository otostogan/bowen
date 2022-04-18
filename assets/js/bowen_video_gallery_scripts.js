/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "../src/js/main.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "../src/js/main.js":
/*!*************************!*\
  !*** ../src/js/main.js ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.addEventListener('DOMContentLoaded', ()=>{
    
   
    const trigger = document.querySelector('.sorter__load span'), 
        allI = document.querySelector('[data-all]').dataset.all,
        perP = document.querySelector('[data-perpage]').dataset.perpage,
        pageID = document.querySelector('[data-id]').dataset.id,
        dataMax = document.querySelector('[data-max]').dataset.max, 
        drop = document.querySelector('.sorter__filter-drop');

    let page = document.querySelector('[data-page]').dataset.page;


    drop.addEventListener('click', ()=>{
        document.querySelector('.sorter__filter-list').classList.toggle('active');
    })
    trigger.addEventListener('click', ()=>{
        fetch();
    })
    async function fetch(){
        const url = bowen_ajax.ajax_url;
        const data = {
            action: 'load',
            allI,
            perP,
            page,
            pageID
        };
        if(+page < +dataMax){
            await jQuery.post(url, data, function(response){
                jQuery(function($) {
                    $('.sorter__content').append(response);
                });
                page++;
                document.querySelector('[data-page]').setAttribute('data-page', page);

                if(page == dataMax){
                    trigger.style.display = 'none';
                }

                const toReload = document.querySelector('#oba_youtubepopup_activate-js').src;
                document.querySelector('#oba_youtubepopup_activate-js').remove();

                setTimeout(()=>{
                    reloadScript(toReload, 'oba_youtubepopup_activate-js');
                }, 300)
                
            }, "html");
        }
    }    
    function reloadScript(url, id) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        script.id = id
        document.body.appendChild(script);
    }    
});

/***/ })

/******/ });
//# sourceMappingURL=bowen_video_gallery_scripts.js.map