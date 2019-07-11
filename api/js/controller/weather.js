Vue.component('show-weather', {
    props:  ['weather'],
    template: ' <div>\
                    <strong class="w3-xlarge">Porto Alegre / RS</strong><br/>\
                    <span class="w3-xxlarge">{{weather.temperatura}}ºC</span><br/>\
                    <span>{{weather.tempo_desc}}</span><br/>\
                    <span>{{weather.umidade}}</span><br/>\
                    <span class="w3-medium">{{weather.atualizacao}}</span>\
                </div>',
});

var app = new Vue({
    el: "#weather",
    data: {
        weatherJSON:{}
    },
    methods:{
        load_weather: function(){
            axios
                .get('http://localhost:8888/api/weather')
                .then(response=>{
                    this.weatherJSON = response.data;
                });
        },
    },
    created: function(){
        this.load_weather();
    }
});