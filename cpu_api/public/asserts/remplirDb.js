console.log("ok");
import { Db } from "./Db.js";
import { Pays } from "./Pays.js";
import { GetPostApi } from "./GetPostAPI.js";

const urlJson = "https://raw.githubusercontent.com/ARFP/arfp.github.io/projets/machine-a-voter/docs/tp/web/api/api-cpuz/cpuz.json";

const app = {
    data() {
        return {
            statutPost: "En attente",
            jsontmp: []



        }
    },
    async mounted() {

        let collection = await GetPostApi.obtenirCollection('pays');
        if (collection.length > 0) {
            this.statutPost = "Base de donnée déjà remplie ! ";
            return collection;
        }

        let json = await Db.fetchJson(urlJson);
        // this.jsontmp = JSON.parse(json);
        let collectionPsh = [];

        for (let item of json) {

            let pays = new Pays(item);
            let newPays = pays.nouveauPays();
            let paysDb = await GetPostApi.postApi(newPays, 'pays');

            collectionPsh.push(paysDb);


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