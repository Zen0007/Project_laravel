import { createClient } from "@supabase/supabase-js";

export const supabase = createClient(
    import.meta.env.VITE_SUPABASE_URL,
    import.meta.env.VITE_SUPABASE_ANON_KEY,
);

const API_BASE_URL = "http://localhost:8080/api";

export const API_ENDPOINTS = {
    articles: `${API_BASE_URL}/articles`,
    articleById: (id) => `${API_BASE_URL}/articles/${id}`,
    articleBySlug: (slug) => `${API_BASE_URL}/articles/${slug}`,
};

export const API_HEADERS = {
    "Content-Type": "application/json",
};
