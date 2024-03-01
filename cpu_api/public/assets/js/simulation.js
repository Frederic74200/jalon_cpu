console.log("ok");
import { Db } from "./Db.js";
import { Cpu } from "./Cpu.js";
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
            test: [1, 5]
        }
    },
    async mounted() {

        let json = await Db.fetchJson(urlJson);

        for (let item of json) {
            this.listLines.push(new CpuProduction(item));
        }

        console.log(this.listLines);

    },
    computed: {
        /*  entries() {
             return this.listCpu.length;
         } */

        /*  addOne() {
             return this.rgval++; 
         } */


    },
    methods: {
        addProd() {

            // Définir un intervalle unique en dehors de la boucle
            const waitInterval = setInterval(() => {
                // Incrémenter rgval
                this.prval += 1;

                // Vérifier si rgval est supérieur ou égal à 10
                if (this.prval >= 10) {
                    // Arrêter l'intervalle
                    clearInterval(waitInterval);

                }
                else {

                    // Définir un intervalle unique en dehors de la boucle
                    const interval = setInterval(() => {
                        // Incrémenter rgval
                        this.rgval += 1;

                        // Vérifier si rgval est supérieur ou égal à 10
                        if (this.rgval >= 10) {
                            // Arrêter l'intervalle
                            clearInterval(interval);
                            this.rgval = 0;

                        }
                    }, 100);

                }
            }, 1000);

        },


        plusUn() {
            while (this.test[0] < 1000) {
                this.test[0]++;
                this.test[1]++;
            }

        }

        /*   changeStock() {
              let newStock = Cpu.newStock(this.nbStck);
              let adCpu = GetPostApi.patchApi(newStock, 'cpu', this.cpuId);
              // window.location("http://localhost:3000/cpuz.html");
              location.reload(true);
          } */
    }
}

Vue.createApp(app).mount('#app');