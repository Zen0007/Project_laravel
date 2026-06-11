import { pool } from "./db";

export async function insertArticle({
    title,
    slug,
    content,
    tags = [],
    coverImage = null,
}) {
    const query = `
    INSERT INTO articles(
        title,
        slug,
        content,
        tags,
        cover_image
    )
    VALUES ($1, $2, $3, $4, $5)
    RETURNING *;
    `;

    const values = {
        title,
        slug,
        content,
        tags,
        coverImage,
    };

    const { rows } = await pool.query(query, values);

    return rows[0];
}

export async function getArticleBySlug(slug) {
    const query = `
        SELECT *
        FROM articles
        WHERE slug = $1
        LIMIT 1;
    `;

    const { rows } = await pool.query(query, [slug]);

    return rows[0] || null;
}

export async function getArticles() {
    const query = `
        SELECT
            id,
            title,
            slug,
            tags,
            cover_image,
            created_at
        FROM articles
        ORDER BY created_at DESC;
    `;

    const { rows } = await pool.query(query);

    return rows;
}
