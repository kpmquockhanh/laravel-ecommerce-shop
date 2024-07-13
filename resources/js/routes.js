import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "home",
    component: () => import("../views/frontend_v2/HomePage.vue")
  },
  {
    path: "/posts/:slug",
    name: "post_single",
    component: () => import("../views/frontend_v2/PostSinglePage.vue")
  },
  {
    path: "/products",
    name: "product_list",
    component: () => import("../views/frontend_v2/Catalogue.vue")
  },
  {
    path: "/products/:slug",
    name: "product-detail",
    component: () => import("../views/frontend_v2/ProductDetail.vue")
  },
  {
    path: "/cart",
    name: "cart",
    component: () => import("../views/frontend_v2/ShoppingCart.vue")
  },

  {
    path: "/login",
    name: "login",
    component: () => import("../views/frontend_v2/LoginPage.vue")
  },

  // Not found
  {
    path: "/:catchAll(.*)?",
    name: "404",
    component: () => import("../views/frontend_v2/components/core/404.vue")
  }
];

const router = createRouter({ history: createWebHistory(), routes });
export default router;
