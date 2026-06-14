// src/services/article.service.js

import { supabase } from "./supabase";

export class ArticleService {
    static table = "articles";

    static async getAll() {
        const { data, error } = await supabase
            .from(this.table)
            .select("*")
            .order("created_at", {
                ascending: false,
            });

        if (error) throw error;

        return data ?? [];
    }

    static async getById(id) {
        const { data, error } = await supabase
            .from(this.table)
            .select("*")
            .eq("id", id)
            .single();

        if (error) throw error;

        return data;
    }

    static async getBySlug(slug) {
        const { data, error } = await supabase
            .from(this.table)
            .select("*")
            .eq("slug", slug)
            .single();

        if (error) throw error;

        return data;
    }

    static async getByTag(tag) {
        const { data, error } = await supabase
            .from(this.table)
            .select("*")
            .contains("tags", [tag]);

        if (error) throw error;

        return data ?? [];
    }

    static async create(article) {
        const payload = {
            title: article.title,
            slug: article.slug || this.slugify(article.title),
            excerpt: article.excerpt || "",
            content: article.content,
            cover_image: article.cover_image || "",
            tags: article.tags || [],
            read_time: article.read_time || null,
        };

        const { data, error } = await supabase
            .from(this.table)
            .insert(payload)
            .select()
            .single();

        if (error) throw error;

        return data;
    }

    static async update(id, article) {
        const { data, error } = await supabase
            .from(this.table)
            .update(article)
            .eq("id", id)
            .select()
            .single();

        if (error) throw error;

        return data;
    }

    static async delete(id) {
        const { error } = await supabase.from(this.table).delete().eq("id", id);

        if (error) throw error;

        return true;
    }

    static slugify(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, "")
            .replace(/\s+/g, "-")
            .replace(/-+/g, "-");
    }

    static formatDate(date) {
        return new Date(date).toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });
    }

    static buildTagsHtml(tags = []) {
        const classMap = {
            golang: "tag-golang",
            rust: "tag-rust",
            python: "tag-python",
            javascript: "tag-javascript",
            devops: "tag-devops",
            database: "tag-database",
        };

        return tags
            .map(
                (tag) => `
                <span
                    class="${classMap[tag] ?? ""} font-mono text-xs px-2 py-1 rounded-md"
                >
                    #${tag}
                </span>
            `,
            )
            .join("");
    }

    static renderCard(article) {
        return `
        <article
            class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer"
            data-tags="${article.tags?.join(",") ?? ""}"
            onclick="showArticle(${article.id})"
        >
            <div class="h-44 bg-surfaceLight relative overflow-hidden">
                <img
                    src="${article.cover_image}"
                    alt="${article.title}"
                    class="w-full h-full object-cover opacity-60"
                >
            </div>

            <div class="p-5">
                <div class="font-mono text-xs text-textMuted mb-2">
                    ${this.formatDate(article.created_at)}
                    ·
                    ${article.read_time ?? ""}
                </div>

                <h3 class="font-semibold text-textPrimary mb-2 leading-snug">
                    ${article.title}
                </h3>

                <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">
                    ${article.excerpt ?? ""}
                </p>
            </div>
        </article>
        `;
    }
}
