<!-- Used in askthepros -->
<template>
  <div class="filter">
    <div class="input-group" style="positive: relative;">
      <select class="btn btn-primary select-btn" v-model="filterValue" @change="selectCategory" v-if="category.length !== 1">
        <option class="dropdown-title" v-for="(item, index) in category" :value="index" :key="index" :style="{background: item.background, border: item.border}">
          {{item.title}}
        </option>
      </select>
      <button class="btn btn-primary select-btn" v-if="category.length === 1">
          {{category[0].title}}
      </button>
      <select class="btn btn-warning select-btn dropdown" v-model="sortValue" @change="changeSort" v-if="activeSort !== null">
        <option class="dropdown" v-for="(item, index) in activeSort" :value="index" :key="index">
          {{item.title}}
        </option>
      </select>
      <input
        type="text"
        class="form-control"
        v-model="searchValue"
        @keypress="keypressHandler"
        :placeholder="'Search ' + '...'" 
        v-if="(activeSort !== null && activeSort[sortValue].type !== 'date' && activeSort[sortValue].type !== 'custom-date')"
        style="padding-left:40px"
      >
       <!-- Date Tag -->
      <date-picker
        v-if="(activeSort !== null && activeSort[sortValue].type === 'date')"
        v-model="searchValue"
        :type="'date'"
        :value-type="'YYYY-MM-DD'"
        :use12h="true"
        :placeholder="'Search date'"
        :format="'MMM D, YYYY'"
        :input-class="'form-control'"
        :input-attr="{style: 'height: 40px !important; width: 100% !important; border-right-style: none;'}"
      ></date-picker>

      <!-- Date Tag -->
      <div v-if="(activeSort !== null && activeSort[sortValue].type === 'custom-date')" style="width: 100%;" class="form-control">
        
        <div class="form-group form-group-three margin-left">
          <input type="number" class="form-control-custom form-control" placeholder="YYYY" v-model="manufacturing.year">
        </div>

        <div class="form-group form-group-three margin-right">
          <select class="form-control-custom  form-control" v-model="manufacturing.month">
            <option v-for="(item, index) in months" :key="index" :value="item.code">{{item.title}}</option>
          </select>
        </div>

        <div class="form-group form-group-three margin-right">
          <select class="form-control-custom  form-control" v-model="manufacturing.date">
            <option value="">Select date</option>
            <option v-for="i in 31" :key="i" :value="i">{{i}}</option>
          </select>
        </div>

      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import "~assets/style/colors.scss";
.filter{
  width: 100%;
  float: left;
  height: 50px;
}
.text-primary{
  color: $primary !important;
}
.form-control{
  height: 50px !important;
  width: 100% !important;
}
.input-group{
  margin-bottom: 10px !important;
}
.input-group-addon{
  width: 100px !important;
  background: #22b173 !important;
  color: #fff !important;
}
.input-group-title{
  width: 100px !important;
  background: #028170 !important;
  color: #fff !important;
}
.btn{
  border-radius: 0px !important;
  height: 50px!important;
}
.select-btn{
  border-top-left-radius: 0px !important;
  border-bottom-left-radius: 0px !important;
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
}
.search-icon{
  position: absolute;
  font-size: 24px;
  right: 50px;
  top: 0px;
  z-index: 1000;
}
.mx-datepicker,
.mx-input-wrapper {
  width: 100%;
  position: unset;
  display: unset;
}
.form-group{
  margin-bottom: 0px !important;
}
.form-group-three{
  width: 33% !important;
  float: left;
}
.form-control-custom{
  border: 0px !important;
  height: 35px !important;
  margin-top: 1px !important;
}
.dropdown-title{
    background: #01004E!important;
}   
.dropdown {
  background: #FFFFFF!important;
  border: 1px solid #01004E;  
  color: #01004E;
  box-sizing: border-box;
}
@media (max-width: 650px){
  .dropdown {
      width: 20%;
  }
  .dropdown-title {
    font-size: 10px;
  }
  .search-icon{
    right: 50px;
  }
}
.view-option{
    color: $primary;
    font-size: 40px;
    line-height: 20%;
    border: solid 1px #ccc;
    height: 40px;
    padding: 5px;
    font-size: 29px;
    i:hover{
    cursor: pointer;
    color: $secondary;
  }
}
.search{
  border-left-style: none;
}
@media (max-width: 992px){
  .search-icon{
    right: 50px;
  }
}
</style>
<script>
import ROUTER from 'src/router'
import AUTH from 'src/services/auth'
import CONFIG from 'src/config.js'
import axios from 'axios'
import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
export default {
  mounted(){
    this.activeCategoryIndex = this.activeCategoryIndex !== null ? this.activeCategoryIndex : 0
    this.activeSortingIndex = this.activeSortingIndex !== null ? this.activeSortingIndex : 0
    this.activeCategory = this.category[this.activeCategoryIndex]
    this.activeSort = this.category[this.activeCategoryIndex].sorting
    this.filterValue = this.activeCategoryIndex
    this.sortValue = this.activeSortingIndex
    var date = new Date()
    this.manufacturing.year = date.getFullYear()
    this.manufacturing.month = (parseInt(date.getMonth()) + 1)
  },
  data(){
    return {
      manufacturing: {
        date: '',
        month: null,
        year: null
      },
      user: AUTH.user,
      config: CONFIG,
      searchValue: '',
      filterValue: 0,
      sortValue: 0,
      title: '',
      payload: '',
      payloadValue: '',
      SortOrder: '',
      sortData: {
        'title': 'asc'
      },
      activeCategory: null,
      activeSort: null,
      itemTemp: {
        'payload': 'title',
        'payload_value': 'asc',
        'title': 'Title ascending'
      },
      toggleStyle: 0,
      toggleFlag: false,
      months: [{
        title: 'January',
        code: 1
      }, {
        title: 'Febuary',
        code: 2
      }, {
        title: 'March',
        code: 3
      }, {
        title: 'April',
        code: 4
      }, {
        title: 'May',
        code: 5
      }, {
        title: 'June',
        code: 6
      }, {
        title: 'July',
        code: 7
      }, {
        title: 'August',
        code: 8
      }, {
        title: 'September',
        code: 9
      }, {
        title: 'October',
        code: 10
      }, {
        title: 'November',
        code: 11
      }, {
        title: 'December',
        code: 12
      }]
    }
  },
  props: ['category', 'activeCategoryIndex', 'activeSortingIndex', 'grid'],
  components: {
    DatePicker
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    retrieve(){
      //
    },
    changeView(){
      if(this.toggleStyle < this.grid.length - 1 && this.toggleFlag === false){
        this.toggleStyle++
        if(this.toggleStyle === this.grid.length - 1){
          this.toggleFlag = true
        }
      }else if(this.toggleStyle > 0 && this.toggleFlag === true){
        this.toggleStyle--
        if(this.toggleStyle === 0){
          this.toggleFlag = false
        }
      }
      this.$emit('changeStyle', this.grid[this.toggleStyle])
    },
    selectCategory(){
      this.activeSort = this.category[this.filterValue].sorting
      this.activeCategory = this.category[this.filterValue]
      this.sortValue = this.filterValue
      this.changeSort()
    },
    changeSort(){
      let object = {}
      let filter = null
      if(this.activeSort[this.sortValue].type === 'custom-date'){
        filter = {
          column: this.activeSort[this.sortValue].payload,
          value: this.manufacturing.year + '-' + this.manufacturing.month + ((this.manufacturing.date === null || this.manufacturing.date === '') ? '' : '-' + this.manufacturing.date)
        }
      }else{
        filter = {
          column: this.activeSort[this.sortValue].payload,
          value: this.searchValue
        }
      }
      object[this.activeSort[this.sortValue].payload] = this.activeSort[this.sortValue].payload_value
      let parameter = {
        sort: object,
        filter: filter,
        filterValue: this.filterValue
      }
      this.$emit('changeSortEvent', parameter)
    },
    keypressHandler(event){
      if(event.charCode === 13){
        let object = {}
        let filter = {
          column: this.activeSort[this.sortValue].payload,
          value: this.searchValue
        }
        object[this.activeSort[this.sortValue].payload] = this.activeSort[this.sortValue].payload_value
        let parameter = {
          sort: object,
          filter: filter,
          filterValue: this.filterValue
        }
        this.$emit('changeSortEvent', parameter)
      }
    }
  }
}
</script>
