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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/calendar.js":
/*!**********************************!*\
  !*** ./resources/js/calendar.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var htmlContent = "";
  var FebNumberOfDays = "";
  var counter = 1;
  var dateNow = new Date();
  var month = 10; //dateNow.getMonth()

  var day = dateNow.getDate();
  var year = dateNow.getFullYear();
  var nextMonth = month + 1;
  var prevMonth = month - 1; //Determing if February (28,or 29)

  if (month == 1) {
    if (year % 100 != 0 && year % 4 == 0 || year % 400 == 0) {
      FebNumberOfDays = 29;
    } else {
      FebNumberOfDays = 28;
    }
  } // names of months and week days.


  var monthNames = ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"];
  var dayNames = ["日", "一", "二", "三", "四", "五", "六"];
  var dayPerMonth = ["31", "" + FebNumberOfDays + "", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31"]; // days in previous month and next one , and day of week.

  var nextDate = new Date(nextMonth + ' 1 ,' + year);
  var weekdays = nextDate.getDay();
  var weekdays2 = weekdays;
  var numOfDays = dayPerMonth[month]; // this leave a white space for days of pervious month.

  while (weekdays > 0) {
    htmlContent += "<td class='monthPre'></td>";
    weekdays--;
  } // loop to build the calendar body.


  while (counter <= numOfDays) {
    // When to start new line.
    if (weekdays2 > 6) {
      weekdays2 = 0;
      htmlContent += "</tr><tr>";
    } // if counter is current day.
    // highlight current day using the CSS defined in header.


    if (counter == day) {
      htmlContent += "<td class='dayNow'>" + counter + "</td>"; // onMouseOver='this.style.background=\"#FFFF00\"; this.style.color=\"#FFFFFF\"' "+ "onMouseOut='this.style.background=\"#FFFFFF\"; this.style.color=\"#00FF00\"'
    } else {
      htmlContent += "<td class='monthNow'>" + counter + "</td>"; // onMouseOver='this.style.background=\"#FFFF00\"'"+ " onMouseOut='this.style.background=\"#FFFFFF\"'
    }

    weekdays2++;
    counter++;
  } // building the calendar html body.


  var calendarBody = "<table class='calendar'> <tr class='monthNow'><th colspan='7'>" + monthNames[month] + " " + year + "</th></tr>";
  calendarBody += "<tr class='dayNames'>  <td>" + dayNames[0] + "</td>  <td>" + dayNames[1] + "</td> <td>" + dayNames[2] + "</td>" + "<td>" + dayNames[3] + "</td> <td>" + dayNames[4] + "</td> <td>" + dayNames[5] + "</td> <td>" + dayNames[6] + "</td> </tr>";
  calendarBody += "<tr>";
  calendarBody += htmlContent;
  calendarBody += "</tr></table>"; // set the content of div .

  $('#calendar1').append(calendarBody);
});

/***/ }),

/***/ 3:
/*!****************************************!*\
  !*** multi ./resources/js/calendar.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/zhangjunyan/website/college_v2/resources/js/calendar.js */"./resources/js/calendar.js");


/***/ })

/******/ });