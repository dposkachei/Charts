<script type="text/javascript">
    $(function () {
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: "{{ $model->id }}",
                @include('charts::_partials.dimension.js')
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            @if($model->title)
                title: {
                    text:  "{{ $model->title }}",
                    x: -20 //center
                },
            @endif
            tooltip: {
                pointFormat: '{point.y} <b>({point.percentage:.1f}%)</strong>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</strong>: {point.y} ({point.percentage:.1f}%)',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                colorByPoint: true,
                data: [
                    @for($i = 0; $i < count($model->values); $i++)
                        {
                            name: "{{ $model->labels[$i] }}",
                            y: "{{ $model->values[$i] }}"
                        },
                    @endfor
                ]
            }]
        })
    });
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
