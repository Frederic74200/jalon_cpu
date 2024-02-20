class Cpu {

    constructor(_json) {
        this.brand = _json.brand;
        this.family = _json.family;
        this.model = _json.model;
        this.ghz = _json.ghz;
        this.price = _json.price;

    }


    newCpu() {

        return {

            "brand": this.brand,
            "family": this.family,
            "model": this.model,
            "ghz": this.ghz,
            "price": this.price,
        }

    }
}
export { Cpu }; 