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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/d3_pie_chart.js":
/*!**************************************!*\
  !*** ./resources/js/d3_pie_chart.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var width = 500 + 200;
  var height = 500;
  var dataset = [["功", 40], ["過", 60]];
  var outerRadius = 200; //外半徑

  var innerRadius = 0; //內半徑，為0則中間沒有空白

  var arc = d3.svg.arc() //弧生成器
  .innerRadius(innerRadius) //設定內半徑
  .outerRadius(outerRadius); //設定外半徑

  var color = d3.scale.ordinal().range(["#F6F4EF", "#CFCBC5"]); //構造20種顏色的序數比例尺，索引值可以是字串或數字

  var pie = d3.layout.pie() //餅圖佈局
  .sort(null) //不排序，不寫則會從大到小，順時針排序。
  .value(function (d) {
    return d[1];
  }); //設定value值為上面的2二維陣列中的數字

  var piedata = pie(dataset);
  var svg = d3.select(".pie_chart") //新增一個svg並且設定寬高
  .append("svg").attr("width", width).attr("height", height);
  var arcs = svg.selectAll(".arc").data(piedata) //返回是pie(data0)
  .enter().append("g").attr("class", "arc").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")") //將圓心平移到svg的中心
  .append("path").attr("fill", function (d, i) {
    return color(i); //根據下標填充顏色
  }).attr("d", function (d, i) {
    return arc(d); ///呼叫上面的弧生成器
  }).style('stroke', '#CFCBC5').style('stroke-width', '5px');
  var text = svg.selectAll(".text").data(piedata) //返回是pie(data0)
  .enter().append("g").attr("class", "text").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")").append("text").style('text-anchor', function (d, i) {
    //根據文字在是左邊還是右邊，在右邊文字是start，文字預設都是start。
    return (d.startAngle + d.endAngle) / 2 < Math.PI ? 'start' : 'end';
  }).attr('transform', function (d, i) {
    var pos = arc.centroid(d); //centroid(d)計算弧中心

    pos[0] = outerRadius * ((d.startAngle + d.endAngle) / 2 < Math.PI ? 1.15 : -1.15);
    pos[1] *= 2.8; //將文字移動到外面去。

    return 'translate(' + pos + ')';
  }).attr("dy", ".3em") //將文字向下便宜.3em
  .text(function (d) {
    //設定文字
    return d.data[0] + " " + d.data[1] + "%";
  });
  var line = svg.selectAll(".line") //新增文字和弧之間的連線
  .data(piedata) //返回是pie(data0)
  .enter().append("g").attr("class", "line").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")").append("polyline").attr('points', function (d, i) {
    var pos1 = arc.centroid(d),
        pos2 = arc.centroid(d),
        pos3 = arc.centroid(d);
    pos1[0] *= 1.8, pos1[1] *= 1.8;
    pos2[0] *= 2.3, pos2[1] *= 2.3;
    pos3[0] = outerRadius * ((d.startAngle + d.endAngle) / 2 < Math.PI ? 1.4 : -1.4);
    pos3[1] *= 2.3; //pos1表示圓弧的中心邊緣位置，pos2是網上稍微去了一下，pos3就是將pos2平移後得到的位置
    //三點連結在一起就成了線段。

    return [pos1, pos2, pos3];
  }).style('fill', 'none').style('stroke', 'black').style('stroke-width', "2px");
});

/***/ }),

/***/ 1:
/*!********************************************!*\
  !*** multi ./resources/js/d3_pie_chart.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/zhangjunyan/website/college_v2/resources/js/d3_pie_chart.js */"./resources/js/d3_pie_chart.js");


/***/ })

/******/ });