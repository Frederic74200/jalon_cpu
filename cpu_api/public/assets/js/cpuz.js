console.log("ok");
import { Db } from "./Db.js";
import { Cpu } from "./Cpu.js";
import { GetPostApi } from "./GetPostAPI.js";

const urlJson = "http://localhost:3000/api/cpu";

const app = {
    data() {
        return {
            listCpu: [],
            cpuId: "",
            nbStck: 0



        }
    },
    async mounted() {


        let json = await Db.fetchJson(urlJson);

        for (let item of json) {
            this.listCpu.push(new Cpu(item));
        }

        console.log(this.listCpu);

    },
    computed: {
        entries() {
            return this.listCpu.length;
        }
    },
    methods: {
        changeStock() {
            let newStock = Cpu.newStock(this.nbStck);
            let adCpu = GetPostApi.patchApi(newStock, 'cpu', this.cpuId);
            // window.location("http://localhost:3000/cpuz.html");
            location.reload(true);
        }
    }
}

Vue.createApp(app).mount('#app');