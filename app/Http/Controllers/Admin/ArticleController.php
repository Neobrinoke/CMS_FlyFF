<?php

namespace App\Http\Controllers\Admin;

use App\Model\Web\Article;
use App\Model\Web\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends AdminController
{
    /**
     * Show all articles.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::query()->paginate(10);

        return view('admin.article.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show category articles.
     *
     * @param ArticleCategory $category
     * @param string $slug
     * @return Response
     */
    public function categoryIndex(ArticleCategory $category, string $slug)
    {
        if ($slug !== $category->slug) {
            return redirect()->route('article.category.show', [$category, $category->slug]);
        }

        return view('admin.article.index', [
            'articles' => $category->articles()->paginate(5)
        ]);
    }

    /**
     * Show detail of article.
     *
     * @param Article $article
     * @param string $slug
     * @return Response
     */
    public function show(Article $article, string $slug)
    {
        if ($slug !== $article->slug) {
            return redirect()->route('admin.article.show', [$article->id, $article->slug]);
        }

        return view('admin.article.show', [
            'article' => $article,
        ]);
    }

    /**
     * Store new shop in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'image_thumbnail' => 'image',
            'image_header' => 'image'
        ]);

        if ($request->file('image_thumbnail')) {
            $file = $request->file('image_thumbnail')->store('article/thumbnails', [
                'disk' => 'public'
            ]);

            $validatedData['image_thumbnail'] = '/uploads/' . $file;
        }

        if ($request->file('image_header')) {
            $file = $request->file('image_header')->store('article/header', [
                'disk' => 'public'
            ]);

            $validatedData['image_header'] = '/uploads/' . $file;
        }


        $validatedData['authorized_comment'] = $request->input('authorized_comment') ? true : false;

        Article::query()->create($validatedData);

        $request->session()->flash('success', trans('admin/article.create.form.messages.success'));

        return redirect()->route('admin.article.index');
    }

    /**
     * Show edit form for shop.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Article $article)
    {
        $category = ArticleCategory::all();
        return view('admin.article.edit', [
            'article' => $article,
            'categories' => $category
        ]);
    }

    public function create()
    {
        $category = ArticleCategory::all();
        return view('admin.article.create', [
            'categories' => $category
        ]);
    }

    /**
     * Update specific shop.
     *
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'category_id' => 'required',
            'image_thumbnail' => 'image',
            'image_header' => 'image'
        ]);

        if ($request->file('image_thumbnail')) {
            $file = $request->file('image_thumbnail')->store('article/thumbnails', [
                'disk' => 'public'
            ]);

            $validatedData['image_thumbnail'] = '/uploads/' . $file;
        }

        if ($request->file('image_header')) {
            $file = $request->file('image_header')->store('article/header', [
                'disk' => 'public'
            ]);

            $validatedData['image_header'] = '/uploads/' . $file;
        }

        $validatedData['authorized_comment'] = $request->input('authorized_comment') ? true : false;

        $article->update($validatedData);

        $request->session()->flash('success', trans('admin/article.edit.form.messages.success'));

        return redirect()->route('admin.article.show', [$article, $article->slug]);
    }
}
