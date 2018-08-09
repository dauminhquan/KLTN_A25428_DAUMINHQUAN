function getCookie(e){for(var t=e+"=",o=decodeURIComponent(document.cookie),a=o.split(";"),r=0;r<a.length;r++){for(var n=a[r];" "==n.charAt(0);)n=n.substring(1);if(0==n.indexOf(t))return n.substring(t.length,n.length)}return""}function setDepartMent(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:["K27","K28"],t=[],o=[],a=[];$.ajax({url:"/api/admin/manage-statistics/graduate-statistics",headers:{Authorization:"Bearer "+token},data:{course_codes:e},method:"GET",dataType:"json",async:!1,success:function(r){r.data.forEach(function(e){o.push(e.department),a.push({name:e.department,type:"bar",data:e.count,itemStyle:{normal:{label:{show:!0,textStyle:{fontWeight:500}}}},markLine:{data:[{type:"average",name:"Trung bình"}]}})}),e.forEach(function(e){var o=r.course_names.find(function(t){return t.code==e});t.push(o.name)}),toolDepartment(o,t,a)},errors:function(e){console.log(err)}})}function setEvent(){$.ajax({url:"/api/admin/manage-statistics/event-statistics",headers:{Authorization:"Bearer "+token},method:"GET",dataType:"json",async:!1,success:function(e){console.log(e),toolEvent(e.listName,e.go,e.notgo)},errors:function(e){console.log(err)}})}function toolDepartment(e,t,o){require.config({paths:{echarts:"/assets/js/plugins/visualization/echarts"}}),require(["echarts","echarts/theme/limitless","echarts/chart/bar","echarts/chart/line"],function(a,r){var n=a.init(document.getElementById("basic_columns"),r);basic_columns_options={grid:{x:40,x2:40,y:35,y2:25},tooltip:{trigger:"axis"},legend:{data:e},calculable:!0,xAxis:[{type:"category",data:t}],yAxis:[{type:"value"}],series:o},n.setOption(basic_columns_options),window.onresize=function(){setTimeout(function(){n.resize()},200)}})}function toolEvent(e,t,o){require.config({paths:{echarts:"/assets/js/plugins/visualization/echarts"}}),require(["echarts","echarts/theme/limitless","echarts/chart/bar","echarts/chart/line"],function(a,r){var n=a.init(document.getElementById("thermometer_columns"),r);thermometer_columns_options={grid:{x:35,x2:10,y:35,y2:25},tooltip:{trigger:"axis",axisPointer:{type:"shadow"},formatter:function(e){return e[0].name+"<br/>"+e[0].seriesName+": "+e[0].value+"<br/>"+e[1].seriesName+": "+e[1].value+"<br/>Số người đăng ký: "+(e[1].value+e[0].value)}},legend:{selectedMode:!1,data:["Số người đi","Số người không đi"]},calculable:!0,xAxis:[{type:"category",data:e}],yAxis:[{type:"value",boundaryGap:[0,.1]}],series:[{name:"Số người đi",type:"bar",stack:"sum",barCategoryGap:"50%",itemStyle:{normal:{color:"#FF7043",barBorderColor:"#FF7043",barBorderWidth:6,label:{show:!0,position:"insideTop"}},emphasis:{color:"#FF7043",barBorderColor:"#FF7043",barBorderWidth:6,label:{show:!0,textStyle:{color:"#fff"}}}},data:t},{name:"Số người không đi",type:"bar",stack:"sum",itemStyle:{normal:{color:"#fff",barBorderColor:"#FF7043",barBorderWidth:6,barBorderRadius:0,label:{show:!0,position:"top",formatter:function(e){for(var t=0,o=thermometer_columns_options.xAxis[0].data.length;t<o;t++)if(thermometer_columns_options.xAxis[0].data[t]==e.name)return thermometer_columns_options.series[0].data[t]+e.value},textStyle:{color:"#FF7043"}}},emphasis:{barBorderColor:"#FF7043",barBorderWidth:6,label:{show:!0,textStyle:{color:"#FF7043"}}}},data:o}]},n.setOption(thermometer_columns_options),window.onresize=function(){setTimeout(function(){basic_columns.resize(),n.resize()},200)}})}var token=getCookie("token");setDepartMent(),setEvent(),$(document).ready(function(){$("#departments").change(function(){setDepartMent($(this).val())})});