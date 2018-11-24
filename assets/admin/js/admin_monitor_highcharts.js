/**
 * 统计
 *
 */
$(document).ready(function(){
    if(x !=''){
        if(type == 2) {
            $('#container_high').highcharts({
                title: {
                    text: title,
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    //                    categories: ['06-01', '06-02', '06-03', '06-04', '06-05', '06-06','06-07', '06-08', '06-09', '06-10', '06-11', '06-12', '06-13', '06-14', '06-15']
                    categories: x
                },
                yAxis:[
                    {
                        title: {
                            text:yname
                        },
                        min:0, // 定义最小值
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    {
                        min:0, // 定义最小值  
                        title: {
                            text:yname
                        },
                        opposite: true
                    }
                ],
                //tooltip: {
                //valueSuffix: '个'
                //},
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                credits: {
                    enabled:true,
                    text:'xyzs.com',
                    href:'http://www.xyzs.com'
                },
                series: data
            });
        } else {
            $('#container_high').highcharts({
                title: {
                    text: title,
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    //                    categories: ['06-01', '06-02', '06-03', '06-04', '06-05', '06-06','06-07', '06-08', '06-09', '06-10', '06-11', '06-12', '06-13', '06-14', '06-15']
                    categories: x
                },
                yAxis: {
                    title: {
                        text:yname                        },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                //tooltip: {
                //valueSuffix: '个'
                //},
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                credits: {
                    enabled:true,
                    text:'xyzs.com',
                    href:'http://www.xyzs.com'
                },
                series: [
                    {
                        name: xname,
                        data: y
                    }

                ]
            });
        }
    }
});

