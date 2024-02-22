class GetPostApi {




    static async postApi(_newPost, _collection) {

        let options = {
            method: 'POST',
            headers: {
                accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(_newPost)
        }

        let response = await fetch("http://localhost:3000/api/" + _collection, options);

        if (response.status == 201) {
            let json = response.json();
            return json;
        }

        throw new Error("La data n'a pas été enregistrée !");
    }


    static async obtenirCollection(_collection) {
        let url = "http://localhost:3000/api/" + _collection;

        let options = {
            method: 'GET',
            headers: {
                accept: 'application/json'
            }
        };

        let response = await fetch(url, options);
        return response;
    }



    static async patchApi(_newPatch, _collection, _id) {

        let options = {
            method: 'PATCH',
            headers: {
                accept: 'application/json',
                'Content-Type': 'application/merge-patch+json'
            },
            body: JSON.stringify(_newPatch)
        }



        let response = await fetch("http://localhost:3000/api/" + _collection + '/' + _id, options);

        if (response.status == 200) {
            let json = response.json();
            return json;
        }

        throw new Error("La data n'a pas été enregistrée !");
    }

}
export { GetPostApi }