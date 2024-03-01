import { Production } from "./Production.js";

class CpuProduction {

    constructor(_json) {
        this.id = _json.id;
        this.name = _json.name;
        this.description = _json.description;
        this.productionTime = _json.productionTime;
        let str = _json.cpu.split("/");
        this.cpu = str[3];
        this.Production = new Production(str[3], _json.productionTime)
    }

}
export { CpuProduction }; 