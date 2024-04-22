import axiosClient from "../axios";

export function getUser({ commit }) {
    return axiosClient.get("/user").then((response) => {
        commit("setUser", response.data);
        return response;
    });
}

export function login({ commit }, data) {
    return axiosClient.post("/login", data).then(({ data }) => {
        console.log("aqui chegou");
        commit("setUser", data.user);
        commit("setToken", data.token);
        console.log("login", data);

        return data;
    });
}

export function logout({ commit }) {
    return axiosClient.post("/logout").then((response) => {
        commit("setToken", null);

        return response;
    });
}

export function getProducts({ commit },{url = null,search = '',perPage = 10,sort_field,sort_direction }) {
    commit("setProducts", [true]);
    url = url || '/product'

    return axiosClient.get( url,{
        params:{
            search,
            per_page:perPage,
            sort_field,
            sort_direction
        }
    })
    .then((res) => {
        commit("setProducts", [false,res.data]);
    }).catch(() => {
       commit("setProducts",[false])
    })
}