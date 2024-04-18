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

export function getProducts({ commit }) {
    commit("setProducts", [true]);
    return axiosClient.get("product")
    .then((res) => {
        commit("setProducts", [false,res.data]);
    }).catch(() => {
       commit("setProducts",[false])
    })
}
