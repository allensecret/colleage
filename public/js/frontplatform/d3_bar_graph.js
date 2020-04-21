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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/d3_bar_graph.js":
/*!**************************************!*\
  !*** ./resources/js/d3_bar_graph.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var data = [50, 20, 90]; // for (var i = 0; i < 3; i++) {
  //     data.push( Math.floor(Math.random() * 7) + 2);
  // }

  var svg = d3.select('.bar_graph').append('svg');

  function rendering() {
    // 將畫布尺寸改成即時取得的寬高
    var margin = 30,
        //parseInt(d3.select('.bar_graph').style('margin')),
    width = parseInt(d3.selectAll(".bar_graph").style("width"), 10) - margin * 2,
        height = parseInt(d3.selectAll(".bar_graph").style("height"), 10) - margin * 2;
    console.log("width:" + (parseInt(d3.select('.bar_graph').style('width'), 10) - margin * 2));
    console.log("width:" + (parseInt(d3.select('.bar_graph').style('height'), 10) - margin * 2));
    svg.html('');
    svg.attr({
      "width": width + margin * 2,
      "height": height + margin * 2,
      "transform": "translate(" + 10 + "," + 10 + ")"
    });
    var xScale = d3.scale.linear().domain([0, data.length]).range([0, width]);
    var yScale = d3.scale.linear().domain([0, 100]).range([0, height]);
    var yScale2 = d3.scale.linear().domain([0, 100]).range([height, 0]);
    var yAxis = d3.svg.axis().scale(yScale2).orient("left");
    svg.selectAll('.bar').data(data).enter().append('g').classed('bar', true).append('rect').attr({
      'x': function x(d, i) {
        return xScale(i) + margin + 10;
      },
      'y': function y(d, i) {
        return height - yScale(d) + margin;
      },
      'width': '10%',
      'height': function height(d, i) {
        return yScale(d);
      },
      'fill': 'rgb(246,244,239)'
    });
    svg.append("g").attr({
      "class": "y axis",
      "transform": "translate(" + margin + ", " + margin + ")"
    }).call(yAxis);
    svg.select('.x.axis').selectAll('.tick text').attr("dx", width * 0.05);
    svg.select('.x.axis').selectAll('.tick line').attr('transform', 'translate(' + width * 0.05 + ', 0)');
    svg.selectAll('.bar').attr('transform', 'translate(' + width * 0.02 + ', 0)');
  }

  d3.select(window).on('resize', rendering);
  rendering();
});

/***/ }),

/***/ 2:
/*!********************************************!*\
  !*** multi ./resources/js/d3_bar_graph.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/zhangjunyan/website/college_v2/resources/js/d3_bar_graph.js */"./resources/js/d3_bar_graph.js");


/***/ })

/******/ });