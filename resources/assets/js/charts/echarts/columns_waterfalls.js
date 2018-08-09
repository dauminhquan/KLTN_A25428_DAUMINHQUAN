/* ------------------------------------------------------------------------------
 *
 *  # Echarts - columns and waterfalls
 *
 *  Columns and waterfalls chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

const token = getCookie('token')

setDepartMent()
setEvent()
$(document).ready(function () {
    $('#departments').change(

        function(){
            setDepartMent($(this).val())
        }
    )
})


function setDepartMent( course_codes = ['K27','K28']) {
    let course_names = []
    let depart_name = []
    let baseSeries = []
    $.ajax({
        url: '/api/admin/manage-statistics/graduate-statistics',
        headers: {
            'Authorization':'Bearer '+token,
        },
        data: {
            course_codes: course_codes
        },
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(data){
            data.data.forEach(item => {
                depart_name.push(item.department)
                baseSeries.push( {
                    name: item.department,
                    type: 'bar',
                    data: item.count,
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                textStyle: {
                                    fontWeight: 500
                                }
                            }
                        }
                    },
                    markLine: {
                        data: [{type: 'average', name: 'Trung bình'}]
                    }
                })
            })

            course_codes.forEach(item =>{
                let course = data.course_names.find(value => {
                    return value.code == item
                })
                course_names.push(course.name)
            })
            toolDepartment(depart_name,course_names,baseSeries)
        },

        errors: function (error) {
            console.log(err)
        }
    });
}




function setEvent() {
    let course_names = []
    let depart_name = []
    let baseSeries = []
    $.ajax({
        url: '/api/admin/manage-statistics/event-statistics',
        headers: {
            'Authorization':'Bearer '+token,
        },
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(data){
            console.log(data)
            toolEvent(data.listName,data.go,data.notgo)
        },
        errors: function (error) {
            console.log(err)
        }
    });
}




function toolDepartment(depart_name,course_names,baseSeries) {
    require.config({
        paths: {
            echarts: '/assets/js/plugins/visualization/echarts'
        }
    });


    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        function (ec, limitless) {

            var basic_columns = ec.init(document.getElementById('basic_columns'), limitless);



            basic_columns_options = {

                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },


                tooltip: {
                    trigger: 'axis'
                },


                legend: {
                    data: depart_name
                },


                calculable: true,


                xAxis: [{
                    type: 'category',
                    data: course_names
                }],


                yAxis: [{
                    type: 'value'
                }],


                series:baseSeries
            };

            basic_columns.setOption(basic_columns_options);
            window.onresize = function () {
                setTimeout(function () {
                    basic_columns.resize();
                }, 200);
            }
        }
    );
}


function toolEvent(listName,go,notgo) {
    require.config({
        paths: {
            echarts: '/assets/js/plugins/visualization/echarts'
        }
    });


    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        function (ec, limitless) {

            var thermometer_columns = ec.init(document.getElementById('thermometer_columns'), limitless);

            thermometer_columns_options = {

                grid: {
                    x: 35,
                    x2: 10,
                    y: 35,
                    y2: 25
                },

                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow' // 'line' | 'shadow'
                    },
                    formatter: function (params) {
                        return params[0].name + '<br/>'
                            + params[0].seriesName + ': ' + params[0].value + '<br/>'
                            + params[1].seriesName + ': ' + (params[1].value) + '<br/>'
                            + 'Số người đăng ký' + ': ' + (params[1].value + params[0].value);
                    }
                },
                legend: {
                    selectedMode: false,
                    data: ['Số người đi', 'Số người không đi']
                },
                calculable: true,
                xAxis: [{
                    type: 'category',
                    data: listName
                }],
                yAxis: [{
                    type: 'value',
                    boundaryGap: [0, 0.1]
                }],
                series: [
                    {
                        name: 'Số người đi',
                        type: 'bar',
                        stack: 'sum',
                        barCategoryGap: '50%',
                        itemStyle: {
                            normal: {
                                color: '#FF7043',
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    position: 'insideTop'
                                }
                            },
                            emphasis: {
                                color: '#FF7043',
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    textStyle: {
                                        color: '#fff'
                                    }
                                }
                            }
                        },
                        data: go
                    },
                    {
                        name: 'Số người không đi',
                        type: 'bar',
                        stack: 'sum',
                        itemStyle: {
                            normal: {
                                color: '#fff',
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                barBorderRadius: 0,
                                label: {
                                    show: true,
                                    position: 'top',
                                    formatter: function (params) {
                                        for (var i = 0, l = thermometer_columns_options.xAxis[0].data.length; i < l; i++) {
                                            if (thermometer_columns_options.xAxis[0].data[i] == params.name) {
                                                return thermometer_columns_options.series[0].data[i] + params.value;
                                            }
                                        }
                                    },
                                    textStyle: {
                                        color: '#FF7043'
                                    }
                                }
                            },
                            emphasis: {
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    textStyle: {
                                        color: '#FF7043'
                                    }
                                }
                            }
                        },
                        data:notgo
                    }
                ]
            };

            thermometer_columns.setOption(thermometer_columns_options);
            window.onresize = function () {
                setTimeout(function () {
                    basic_columns.resize();
                    thermometer_columns.resize();
                }, 200);
            }
        }
    );
}


