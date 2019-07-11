Vue.component('list-pizzas', {
    props:  ['pizzaslist'],
    template: ' <div>\
                    <span v-for="pizza_item of pizzaslist">\
                        <h1><b>{{pizza_item.pizza}}</b> <span class="w3-right w3-tag w3-dark-grey w3-round">{{ pizza_item.price | currency("R$", 2, { decimalSeparator: "," }) }}</span></h1>\
                        <span class="w3-text-grey" v-for="ing of pizza_item.ingredients"> {{ing.ingredient}}, </span>\
                        <button class="w3-right w3-round w3-hover-red w3-xlarge" v-on:click="add_to_cart(pizza_item)">Adicionar</button>\
                        <hr>\
                    </span>\
                </div>',
    methods:
    {
        add_to_cart: function (pizza)
        {
            axios
                .post('http://localhost:8888/api/cart/add_pizza_cart', pizza)
                .then(response=>{
                    console.log("Response (cart_add): ", response.data);
                });
        },
    },
});

var app = new Vue({
    el: "#Pizza",
    data: {
        pizzas:[]
    },
    mixins: [Vue2Filters.mixin],    // Filters import to currency format
    methods:{
        load_available_pizzas: function(){
            axios
                .get('http://localhost:8888/api/pizza/get_available')
                .then(response=>{
                    this.pizzas = response.data;
                    console.log("Response (pizzas): ", this.pizzas);
                });
        },
    },
    created: function(){
        this.load_available_pizzas();
    }
});