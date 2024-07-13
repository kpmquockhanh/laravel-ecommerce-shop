import { ref } from "vue";
import { useRouter } from "vue-router";
import { doGet } from "../http";
import get from "lodash/get";


export function usePost() {
  const router = useRouter();
  const isLoadingPosts = ref(true);
  const posts = ref([]);
  const fetchPosts = async () => {
    const resp = await doGet("/api/posts");
    posts.value = get(resp, "data", []);
    isLoadingPosts.value = false;
  };

  const fetchPost = async (postId) => {
    const resp = await doGet("/api/posts/" + postId);
    return get(resp, "data", {});
  };


  const fetchRecentPosts = async () => {
    const resp = await doGet("/api/posts/recent_posts");
    posts.value = get(resp, "data", []);
  }

  const goToDetail = async (post) => {
    await router.push({ name: "post_single", params: { slug: post.id } });
  };

  return {
    fetchPosts,
    fetchPost,
    fetchRecentPosts,
    posts,
    isLoadingPosts,
    goToDetail,
  };
}
