<?php

namespace App\Http\Livewire\Article;

use App\Http\Traits\WithModal;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithModal;

    public $article;
    public $searchTerm = '';

    protected $paginationTheme = 'bootstrap';

    protected $searchColumns = ['id','title','body','author',];

    protected $listeners = ['update', 'openDestroy', 'destroy'];


	 public $title;
	 public $body;
	 public $author;

    public function render()
    {
        $searchTerm = "%$this->searchTerm%";

        $articles = Article::query();

        if (strlen($this->searchTerm) > 0) {
            $articles = $articles->where(function ($query) use ($searchTerm) {
                foreach ($this->searchColumns as $column) {
                    $query->orwhere($column, 'like', $searchTerm);
                }
            });
        }

        $articles = $articles->latest()->paginate(8);

        return view('livewire.articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        $this->article = null;
        $this->resetErrorBag();
        $this->emit('openModal');
        $this->resetInputs();
    }

    public function update(Article $article)
    {
        $this->article = $article;
        $this->resetErrorBag();
        $this->emit('openModal');
        $this->resetInputs($article);
    }

    public function openDestroy(Article $article)
    {
        $this->article = $article;
        $this->emit('openDestroyModal');
    }

    public function destroy()
    {
        $this->article->delete();
        $this->emit('toast-success', 'Artigo removida(o) com sucesso');
        $this->emit('closeDestroyModal');
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }

    public function store()
    {
        $data = $this->validate($this->rules());

        isset($this->article)
            ? $this->article->update($data)
            : Article::create($data);

        $this->closeModal();
        $this->emit('toast-success', isset($this->article)
            ? 'Artigo atualizada(o)'
            : 'Artigo criada(o)');
    }

    private function resetInputs(Article $article = null)
    {

			$this->title = $article->title ??'';
			$this->body = $article->body ??'';
			$this->author = $article->author ??'';
		if($article) {
			}
        $this->emit('clear-input');
    }

    public function rules()
    {
        return [
            'title' => 'string|required|min:3',
			'body' => 'string|required',
			'author' => 'string|required|min:3',
        ];
    }

}
