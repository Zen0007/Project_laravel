// src/services/article.service.js

import { supabase } from "./supabase";

const API_HEADERS = {
    "Content-Type": "application/json",
};

const API_BASE_URL = "http://localhost:8080/api";

export class ArticleService {
    static table = "articles";

    static async getAll(page = 1, limit = 10, search = "") {
        const params = new URLSearchParams({
            page: page.toString(),
            limit: limit.toString(),
        });

        if (search) {
            params.append("search", search);
        }

        const response = await fetch(
            `${API_BASE_URL}/articles?${params.toString()}`,
        );

        if (!response.ok) {
            throw new Error("Failed to fetch articles");
        }

        const result = await response.json();

        return {
            data: result.articles || [],
            totalCount: result.total_count || 0,
            page: result.page || 1,
            totalPages: result.total_pages || 1,
        };
    }

    static async getById(id) {
        try {
            // FIXED: Replaced API_ENDPOINTS with template literal string
            const response = await fetch(`${API_BASE_URL}/articles/${id}`, {
                method: "GET",
                headers: API_HEADERS,
            });

            if (!response.ok) {
                if (response.status === 404) {
                    return null;
                }
                const error = await response.json();
                throw new Error(error.error || "Failed to fetch article");
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error(`Error fetching article ${id}:`, error);
            throw error;
        }
    }

    static async getBySlug(slug) {
        try {
            // FIXED: Replaced API_ENDPOINTS with template literal string
            const response = await fetch(`${API_BASE_URL}/articles/${slug}`, {
                method: "GET",
                headers: API_HEADERS,
            });

            if (!response.ok) {
                if (response.status === 404) {
                    return null;
                }
                const error = await response.json();
                throw new Error(
                    error.error || "Failed to fetch article by slug",
                );
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error(`Error fetching article by slug ${slug}:`, error);
            throw error;
        }
    }

    static async getByTag(tag) {
        try {
            const params = new URLSearchParams({
                search: tag,
                page: "1",
                limit: "50",
            });

            // FIXED: Replaced API_ENDPOINTS with template literal string
            const response = await fetch(
                `${API_BASE_URL}/articles?${params.toString()}`,
                {
                    method: "GET",
                    headers: API_HEADERS,
                },
            );

            if (!response.ok) {
                const error = await response.json();
                throw new Error(
                    error.error || "Failed to fetch articles by tag",
                );
            }

            const result = await response.json();

            // Filter articles yang memiliki tag tertentu dalam content
            const filteredArticles = (result.articles || []).filter(
                (article) => {
                    try {
                        const content =
                            typeof article.content === "string"
                                ? JSON.parse(article.content)
                                : article.content;

                        return content.tags && content.tags.includes(tag);
                    } catch {
                        return false;
                    }
                },
            );

            return filteredArticles;
        } catch (error) {
            console.error(`Error fetching articles by tag ${tag}:`, error);
            throw error;
        }
    }

    /**
     * Create new article
     */
    static async create(article) {
        try {
            const payload = {
                title: article.title,
                slug: article.slug || ArticleService.slugify(article.title),
                excerpt:
                    article.excerpt ||
                    article.content?.substring(0, 150) + "..." ||
                    "",
                content: article.content || {},
                cover_image: article.cover_image || "",
            };

            // Jika content adalah string, parse menjadi JSON
            if (typeof payload.content === "string") {
                try {
                    payload.content = JSON.parse(payload.content);
                } catch {
                    payload.content = { text: payload.content };
                }
            }

            // FIXED: Replaced API_ENDPOINTS with template literal string
            const response = await fetch(`${API_BASE_URL}/articles`, {
                method: "POST",
                headers: API_HEADERS,
                body: JSON.stringify(payload),
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.error || "Failed to create article");
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error("Error creating article:", error);
            throw error;
        }
    }

    /**
     * Update article
     */
    static async update(id, article) {
        try {
            const payload = { ...article };

            // Jika content adalah string, parse menjadi JSON
            if (payload.content && typeof payload.content === "string") {
                try {
                    payload.content = JSON.parse(payload.content);
                } catch {
                    payload.content = { text: payload.content };
                }
            }

            // FIXED: Replaced API_ENDPOINTS with template literal string
            const response = await fetch(`${API_BASE_URL}/articles/${id}`, {
                method: "PUT",
                headers: API_HEADERS,
                body: JSON.stringify(payload),
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.error || "Failed to update article");
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error(`Error updating article ${id}:`, error);
            throw error;
        }
    }

    /**
     * Delete article
     */
    static async delete(id) {
        try {
            // FIXED: Replaced API_ENDPOINTS with template literal string
            const response = await fetch(`${API_BASE_URL}/articles/${id}`, {
                method: "DELETE",
                headers: API_HEADERS,
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.error || "Failed to delete article");
            }

            return true;
        } catch (error) {
            console.error(`Error deleting article ${id}:`, error);
            throw error;
        }
    }

    /**
     * Generate slug from text
     */
    static slugify(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, "")
            .replace(/\s+/g, "-")
            .replace(/-+/g, "-")
            .replace(/^-+|-+$/g, "");
    }

    static formatDate(date) {
        return new Date(date).toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });
    }
    static buildTagsHtml(content) {
        const classMap = {
            golang: "tag-golang",
            rust: "tag-rust",
            python: "tag-python",
            javascript: "tag-javascript",
            devops: "tag-devops",
            database: "tag-database",
        };

        // Extract tags from content
        let tags = [];
        try {
            const parsedContent =
                typeof content === "string" ? JSON.parse(content) : content;
            tags = parsedContent.tags || [];
        } catch {
            tags = [];
        }

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

    static estimateReadTime(content) {
        try {
            const parsedContent =
                typeof content === "string" ? JSON.parse(content) : content;

            // Extract text from content (simplified)
            const textContent = JSON.stringify(parsedContent);
            const wordCount = textContent.split(/\s+/).length;
            const readTime = Math.ceil(wordCount / 200); // 200 words per minute

            return `${readTime} min read`;
        } catch {
            return "5 min read";
        }
    }

    /**
     * Render article card HTML
     */
    /**
     * Render article card HTML
     */
    static renderCard(article) {
        const tags = (() => {
            try {
                // If it's an object with a tags property
                if (
                    article.content &&
                    typeof article.content === "object" &&
                    article.content.tags
                ) {
                    return article.content.tags;
                }

                // If it's a JSON string with a tags property
                if (
                    typeof article.content === "string" &&
                    article.content.trim().startsWith("{")
                ) {
                    const parsed = JSON.parse(article.content);
                    return parsed.tags || [];
                }
            } catch (e) {
                console.debug(
                    "Content is not structured JSON, auto-generating tags from title.",
                );
            }

            // FALLBACK: Auto-detect tags from the title or slug if content doesn't have them
            const searchPool = `${article.title} ${article.slug}`.toLowerCase();
            const fallbackTags = [];
            if (searchPool.includes("go")) fallbackTags.push("golang");
            if (searchPool.includes("rust")) fallbackTags.push("rust");
            if (searchPool.includes("python")) fallbackTags.push("python");
            if (
                searchPool.includes("typescript") ||
                searchPool.includes("node") ||
                searchPool.includes("js")
            )
                fallbackTags.push("javascript");

            return fallbackTags;
        })();

        const readTime =
            article.read_time ||
            ArticleService.estimateReadTime(article.content);
        const excerpt = article.excerpt || "";

        return `
        <article
            class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer"
            data-tags="${tags.join(",")}"
            onclick="showArticle('${article.id}')"
            style="transition: opacity 0.2s ease, transform 0.2s ease;"
        >
            <div class="h-44 bg-surfaceLight relative overflow-hidden">
                <img
                    src="${article.cover_image || "https://picsum.photos/seed/" + article.id + "/600/400"}"
                    alt="${article.title}"
                    class="w-full h-full object-cover opacity-60"
                    onerror="this.src='https://picsum.photos/600/400'"
                >
            </div>

            <div class="p-5">
                <div class="font-mono text-xs text-textMuted mb-2 flex justify-between items-center">
                    <span>
                        ${ArticleService.formatDate(article.created_at)} · ${readTime}
                    </span>
                    <span class="text-neonGreen">
                        ${tags.map((t) => "#" + t).join(" ")}
                    </span>
                </div>

                <h3 class="font-semibold text-textPrimary mb-2 leading-snug">
                    ${article.title}
                </h3>

                <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">
                    ${excerpt}
                </p>
            </div>
        </article>
        `;
    }

    /**
     * Handle delete article with confirmation
     */
    static async handleDeleteArticle(id) {
        if (
            !confirm(
                `Apakah Anda yakin ingin menghapus artikel dengan ID #${id}?`,
            )
        )
            return;

        try {
            const success = await ArticleService.delete(id);
            if (success) {
                alert(`Artikel #${id} berhasil dihapus.`);
                window.location.reload();
            }
        } catch (error) {
            console.error("Gagal menghapus artikel:", error);
            alert("Terjadi kesalahan saat menghapus artikel: " + error.message);
        }
    }
    /**
     * Open create article modal
     */
    static openCreateModal() {
        console.log("Membuka modal...");
        const modal = document.getElementById("createArticleModal");
        if (!modal) {
            console.error(
                "Error: Elemen 'createArticleModal' tidak ditemukan!",
            );
            return;
        }
        modal.classList.remove("hidden");
    }

    static closeCreateModal() {
        const modal = document.getElementById("createArticleModal");
        const form = document.getElementById("createArticleForm");
        if (modal) modal.classList.add("hidden");
        if (form) form.reset();
    }

    static async handleCreateArticle(event) {
        event.preventDefault();

        const title = document.getElementById("formTitle")?.value;
        const slug = document.getElementById("formSlug")?.value;
        const contentRaw = document.getElementById("formContent")?.value;
        const tagsInput = document.getElementById("formTags")?.value;

        // Parse content as JSON
        let content;
        try {
            content = JSON.parse(contentRaw);
        } catch {
            // If not valid JSON, wrap in object
            content = {
                text: contentRaw,
                tags: tagsInput
                    ? tagsInput
                          .split(",")
                          .map((tag) => tag.trim().toLowerCase())
                    : [],
            };
        }

        // Add tags to content if not present
        if (!content.tags && tagsInput) {
            content.tags = tagsInput
                .split(",")
                .map((tag) => tag.trim().toLowerCase());
        }

        const articlePayload = {
            title: title,
            slug: slug || undefined,
            content: content,
            excerpt: contentRaw?.substring(0, 150) + "..." || "",
            cover_image:
                "https://picsum.photos/seed/" + Math.random() + "/600/400",
        };

        try {
            const newArticle = await ArticleService.create(articlePayload);
            if (newArticle) {
                alert("Artikel baru berhasil dibuat!");
                ArticleService.closeCreateModal();
                window.location.reload();
            }
        } catch (error) {
            console.error("Gagal membuat artikel:", error);
            alert("Terjadi kesalahan: " + error.message);
        }
    }
}

// EXPOSE KE WINDOW GLOBAL (Wajib untuk interaksi inline HTML onclick)
if (typeof window !== "undefined") {
    window.ArticleService = ArticleService;
}
