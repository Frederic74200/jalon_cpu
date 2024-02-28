class Production {

    constructor(_productionTime, _nbToProduce) {
        this.productionTime = _productionTime;
        this.nbToProduce = _nbToProduce;
        this.interval = 0;
        this.nbProduct = 0;
    }

    getInterVal() {
        return this.interval;
    }

    getNbProduct() {
        return this.nbProduct;
    }

    resetNbproduct() {
        this.nbProduct = 0;
    }


    addProd() {

        // Définir un intervalle unique en dehors de la boucle
        const waitInterval = setInterval(() => {
            // Incrémenter rgval
            this.nbProduct += 1;

            // Vérifier si rgval est supérieur ou égal à 10
            if (this.nbProduct >= this.nbToProduce) {
                // Arrêter l'intervalle
                clearInterval(waitInterval);
            }
            else {

                // Définir un intervalle unique en dehors de la boucle
                const interval = setInterval(() => {
                    // Incrémenter rgval
                    this.interval += 1;

                    // Vérifier si rgval est supérieur ou égal à 10
                    if (this.interval >= this.productionTime) {
                        // Arrêter l'intervalle
                        clearInterval(interval);
                        this.interval = 0;

                    }
                }, this.productionTime * 1000);

            }
        }, this.productionTime * this.nbToProduce * 1000);

    }












}
export { Production }; 