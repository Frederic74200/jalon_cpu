console.log("ok");
import { Db } from "./Db.js";

import { CpuProduction } from "./CpuProduction.js";

import { GetPostApi } from "./GetPostAPI.js";

const urlJson = "http://localhost:3000/api/cpuProduction";

const app = {
    data() {
        return {
            rgval: 0,
            prval: 0,
            listLines: [],
            toto: "tototoot",
            test: 0
        }
    },
    async mounted() {

        let json = await Db.fetchJson(urlJson);

        for (let item of json) {
            this.listLines.push(new CpuProduction(item));
        }



    },
    computed: {



    },
    methods: {

    }
}

Vue.createApp(app).mount('#app');