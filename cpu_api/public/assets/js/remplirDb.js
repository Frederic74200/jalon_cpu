console.log("ok");
import { Db } from "./Db.js";
import { Cpu } from "./Cpu.js";
import { GetPostApi } from "./GetPostAPI.js";

const urlJson = "https://arfp.github.io/tp/web/api/api-cpuz/cpuz.json";

const app = {
    data() {
        return {
            statutPost: "En attente",
            jsontmp: []



        }
    },
    async mounted() {

        let collection = await GetPostApi.obtenirCollection('cpu');
        if (collection.length > 0) {
            this.statutPost = "Base de donnée déjà remplie ! ";
            return collection;
        }

        let json = await Db.fetchJson(urlJson);
        // this.jsontmp = JSON.parse(json);
        let collectionPsh = [];

        for (let item of json) {

            let cpu = new Cpu(item);
            let newCpu = cpu.newCpu();
            let cpuDb = await GetPostApi.postApi(newCpu, 'cpu');

            collectionPsh.push(cpuDb);
        }

        if (collectionPsh.length == json.length) {
            this.statutPost = "Base de donnée a été remplie ! ";
        }
        else {
            this.statutPost = " une erreur est survenue  ! ";
        }
        return collectionPsh;




    },
    computed: {

    },
    methods: {

    }
}

Vue.createApp(app).mount('#app');