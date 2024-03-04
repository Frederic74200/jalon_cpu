import { GetPostApi } from "./GetPostAPI.js";
import { Cpu } from "./Cpu.js";

class Production {

    constructor(_cpuId, _productionTime) {
        this.productionId = "prod" + _cpuId;
        this.cpuId = _cpuId;
        this.productionTime = _productionTime;
        this.stock = 0;
        this.interval = 0;
        this.nbProduct = 0;
        this.nbToProduce = 0;
        this.timeRest = _productionTime;
        this.newStock = null
    }


    async getStock() {

        let json = await GetPostApi.getById('cpu', this.cpuId);

        return json.stock;
    }


    async pachStock(_newStock) {
        let body = Cpu.newStock(_newStock);
        let json = await GetPostApi.patchApi(body, 'cpu', this.cpuId);
        this.newStock = [];
        this.newStock.push(json);
        console.log(json);
    }




    reset() {
        this.nbProduct = 0;
        this.nbProduct = 0;
        this.newStock = null;
        document.getElementById(this.productionId).removeAttribute("disabled");
    }


    addInterval() {
        const interval = setInterval(() => {

            if (this.interval >= this.productionTime) {
                // Arrêter l'intervalle
                clearInterval(interval);
                this.interval = 0; this.nbProduct += 1;
                this.timeRest = this.productionTime
            }
            else {
                this.interval += 1;
                this.timeRest = this.productionTime - this.interval;
            }

        }, 1000);


    }


    async addProd() {

        this.stock = await this.getStock();

        const interval = setInterval(() => {

            if (this.nbProduct == this.nbToProduce) {
                // Arrêter l'intervalle
                clearInterval(interval);
                let stk = this.nbProduct + this.stock;
                this.pachStock(stk);

            }
            else {
                document.getElementById(this.productionId).setAttribute("disabled", "true");
                this.addInterval();
            }


        }, this.nbToProduce * this.productionTime * 1000);



    }












}
export { Production }; 