Vue.component('list-pizzas', {
    props:['list'],
    template: ' <div>\
                    <span v-for="item of list">\
                        <h1><b>{{item.pizza}}</b> <span class="w3-right w3-tag w3-dark-grey w3-round">R$43.00</span></h1>\
                        <span class="w3-text-grey" v-for="ing of item.ingredients"> {{ing.ingredient}}, </span>\
                        <hr>\
                    </span>\
                </div>'
})

//<p class="w3-text-grey">Fresh tomatoes, fresh mozzarella, fresh basil</p>

var app = new Vue({
    el: "#Pizza",
    data: {
        pizzas:[]
    },
    methods:{
        refresh: function(){
            axios
                .get('http://localhost:8888/api/pizza')
                .then(response=>{
                    this.pizzas = response.data.pizzas;
                    console.log("Response: ", this.pizzas);
                });
        },
    },
    created: function(){
        this.refresh();
    }
});