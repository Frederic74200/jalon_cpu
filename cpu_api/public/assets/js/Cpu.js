class Cpu {

    constructor(_json) {
        this.id = _json.id;
        this.brand = _json.brand;
        this.family = _json.family;
        this.model = _json.model;
        this.ghz = _json.ghz;
        this.price = _json.price;
        this.stock = _json.stock;

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
    static newStock(_stock) {
        return {

            "stock": _stock

        }

    }
}
export { Cpu }; 