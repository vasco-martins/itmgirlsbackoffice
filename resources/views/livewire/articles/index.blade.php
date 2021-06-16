<div>
    <div class="card card-accent-info">
        <div class="card-header">{{ __('Pesquisa') }}</div>
        <div class="card-body">
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" wire:model="searchTerm" placeholder="Procurar"
                       aria-label="Username" aria-describedby="addon-wrapping">
            </div>
        </div>
    </div>

    <div class="card card-accent-primary">
        <div class="card-header d-flex align-items-center justify-content-between">
            {{ __('Dashboard') }}
            <button type="button" class="btn btn-primary" wire:click="create">Nova(o) Artigo</button>

        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Título</th>
					<th>Corpo</th>
					<th>Autor(a)</th>
					
                    <th scope="col">Criado a</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>

                @forelse($articles as $articleItem)
                    <tr>
                        <th scope="row">{{ $articleItem->id }}</th>
                        <td>{{ $articleItem->title ?? '' }}</td>
						<td>{{ \Illuminate\Support\Str::words(strip_tags($articleItem->body), 10,'...')  }}</td>
						<td>{{ $articleItem->author ?? '' }}</td>
						

                        <td>{{ $articleItem->created_at->diffForHumans()  }}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" wire:click="$emit('update', {{ $articleItem }})" class="btn btn-warning">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger"
                                        wire:click="$emit('openDestroy', {{ $articleItem }})">Remover
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th>{{ __('Sem resultados') }}</th>
                    </tr>
                @endforelse

                </tbody>
            </table>

            {{ $articles->links() }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="postModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel">{{ isset($article) ? __('Novo Artigos') : __('Editar Artigos') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">

                        


            <label for="basiurl">Título</label>
            <div class="input-group mb-3">
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   wire:model="title" name="Título">
                     @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>


             <label for="basiurl">Corpo</label>

                        <div class="mt-2 bg-white" wire:ignore>
                            <div
                                class=""
                                x-data
                                x-ref="quillEditor"
                                x-init="
         quill = new Quill($refs.quillEditor, {theme: 'snow'});
         quill.on('text-change', function () {
           $dispatch('input', quill.root.innerHTML);
           @this.set('body', quill.root.innerHTML)
         });

         window.livewire.on('clear-input', function() {
            quill.root.innerHTML = @this.get('body');
         });
       "
                                x-on:quill-input.debounce.2000ms="@this.set('body', $event.detail)"
                            >
                                {!! $body !!}
                            </div>

                        </div>

                          <input type="hidden" class="is-invalid">
                        @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            


            <label for="basiurl">Autor(a)</label>
            <div class="input-group mb-3">
                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                   wire:model="author" name="Autor(a)">
                     @error('author')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit"
                            class="btn btn-primary">{{ isset($article) ? __('Atualizar') : __('Criar') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Remover Artigos') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Tem a certeza que pretende remover?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="$emit('destroy')" class="btn btn-danger">Remover</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('script')
    <script type="text/javascript">

        window.livewire.on('openModal', () => {
            $('#postModal').modal('show');
        });
        window.livewire.on('closeModal', () => {
            $('#postModal').modal('hide');
        });
        window.livewire.on('openDestroyModal', () => {
            $('#destroyModal').modal('show');
        });
        window.livewire.on('closeDestroyModal', () => {
            $('#destroyModal').modal('hide');
        });


        






    </script>
@endpush
