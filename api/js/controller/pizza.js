Vue.component('list-pizzas', {
    props:['list'],
    template: ' <p>IIII</p>\
                <div v-for="item of list">\
                    <h1><b>{{item.pizza}}</b> <span class="w3-right w3-tag w3-dark-grey w3-round">$12.50</span></h1>\
                    <p class="w3-text-grey">Fresh tomatoes, fresh mozzarella, fresh basil</p>\
                    <hr>\
                </div>\
                <p>FFFF</p>'
})
    // template: ' <table>\
    //             <tr>\
    //                 <th>MATRICULA</th>\
    //                 <th>NOME</th>\
    //                 <th>TELEFONE</th>\
    //             </tr>\
    //             <tr v-for="item of lista">\
    //                 <td>{{item.matricula}}</td>\
    //                 <td>{{item.nome}}</td>\
    //                 <td>{{item.telefone}}</td>\
    //             </tr>\
    //             </table>'

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
        test: function(){
            console.log("zero: ", this.pizzas);
            function print(item) {
                console.log("Testando: ", item.pizza); 
            }
            this.pizzas.forEach(print);
        }
    },
    created: function(){
        this.refresh();
        setTimeout(this.test, 1000);
    }
});