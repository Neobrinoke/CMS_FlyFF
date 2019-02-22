<?php

namespace App\Http\Controllers;

use App\Model\Web\Article;
use App\Model\Web\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ArticleCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function store(Request $request, Article $article)
    {
        if ($article->authorized_comment) {
            $validatedData = $request->validate([
                'content' => 'required|max:250',
            ]);

            $validatedData['article_id'] = $article->id;
            $validatedData['author_id'] = auth()->id();

            ArticleComment::query()->create($validatedData);

            session()->flash('status', trans('article.comment.submit_comment.comment.create'));
        }

        return redirect()->route('article.show', [$article, $article->slug]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @param ArticleComment $articleComment
     * @return Response
     */
    public function update(Request $request, Article $article, ArticleComment $articleComment)
    {
        if ($article->authorized_comment && $articleComment->is_mine) {
            $validatedData = $request->validate([
                'content' => 'required|max:250',
            ]);

            $articleComment->fill($validatedData);
            $articleComment->save();

            session()->flash('status', trans('article.comment.submit_comment.comment.edit'));
        }

        return redirect()->route('article.show', [$article, $article->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @param ArticleComment $articleComment
     * @return Response
     */
    public function destroy(Article $article, ArticleComment $articleComment)
    {
        if ($article->authorized_comment && $articleComment->is_mine) {
            $articleComment->forceDelete();

            session()->flash('status', trans('article.comment.submit_comment.comment.delete'));
        }

        return redirect()->route('article.show', [$article, $article->slug]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @param ArticleComment $articleComment
     * @return Response
     */
    public function storeResponse(Request $request, Article $article, ArticleComment $articleComment)
    {
        if ($article->authorized_comment && !$articleComment->is_response) {
            $validatedData = $request->validate([
                'content' => 'required|max:250',
            ]);

            $validatedData['article_id'] = $article->id;
            $validatedData['author_id'] = auth()->id();
            $validatedData['comment_id'] = $articleComment->id;

            ArticleComment::query()->create($validatedData);

            session()->flash('status', trans('article.comment.submit_comment.response.create'));
        }

        return redirect()->route('article.show', [$article, $article->slug]);
    }
}
