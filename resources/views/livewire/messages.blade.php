<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div>
                <div class="d-flex">

                    <div class="col-md-4 user-list" style="max-height: 660px;overflow: hidden ; overflow-y: scroll">

                        <div class="users-chat text-center p-2">
                            @if (auth()->user()->role_id == 2)
                                Cố vấn
                            @endif
                            @if (auth()->user()->role_id == 1)
                                Sinh viên
                            @endif
                        </div>
                        <div class="chatbox p-0">
                            <ul class="list-group list-group-flush">
                                @if ($users->first() != null)

                                    @foreach ($users as $user)

                                        @if ($user->id !== auth()->id())
                                            @php
                                                $select = false;
                                                
                                                $not_seen =
                                                    App\Models\Message::where('user_id', $user->id)
                                                        ->where('receiver_id', auth()->id())
                                                        ->where('is_seen', false)
                                                        ->get() ?? null;
                                                
                                            @endphp
                                            <div wire:click="getUser({{ $user->id }})" class="text-dark link"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $user->name }}"
                                                style="border-radius: 10px;margin-bottom: 16px">
                                                <li class="list-group-item d-flex rounded-1"
                                                    style="padding: 7px 10px; cursor: pointer;">
                                                    <div>

                                                        <box-icon type='solid'
                                                            style="background: transparent;     fill: #4b49ac; height: 45px;width: 45px;"
                                                            name='user-circle'></box-icon>
                                                    </div>

                                                    <div class="px-3 py-2 font-weight-bold text-center "
                                                        style="overflow: hidden;
                                                    display: inline-block;white-space: nowrap;text-overflow: ellipsis; ">
                                                        @if ($user->is_online == true)
                                                            <i class="fa fa-circle text-success online-icon">
                                                        @endif

                                                        </i> {{ $user->name . ' ' . $user->msv }}
                                                        @if (filled($not_seen))
                                                            <div class="badge badge-danger rounded">
                                                                {{ $not_seen->count() }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            </div>
                                        @endif
                                    @endforeach

                                @endif
                            </ul>

                        </div>

                    </div>

                    <div class="col-md-8">
                        <div class="card d-flex justify-content-between flex-nowrap align-content-center ">
                            <div class="card-header" style="padding: 0.75rem 1.25rem;
    margin-bottom: 0;
  background-color: #8d8bf1 !important;
  border-radius: 10px;
    border-bottom: 1px solid #e3e3e3;
        border-bottom-right-radius: unset;
    ">
                                @if (isset($sender))
                                    {{ $sender->name . ' ' . $sender->msv }}
                                @endif
                            </div>
                            <div class="card-body flex-shrink-1 message-box" style="height: 580px;"
                                wire:poll="mountdata">
                                @if (filled($allmessages))
                                    @foreach ($allmessages as $mgs)
                                        <div class="single-message @if ($mgs->user_id ==
                                        auth()->id()) sent @else received @endif">
                                            <p class="font-weight-bolder my-0" style="font-size: 16px">
                                                {{ $mgs->message }}</p>

                                            <small class="text-muted w-100">Gửi
                                                <em>{{ $mgs->created_at }}</em></small>
                                        </div>

                                    @endforeach
                                @endif

                            </div>
                            @if (isset($sender))
                                <div class="card-footer">
                                    <form wire:submit.prevent="SendMessage">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input wire:model="message"
                                                    class="form-control input shadow-none w-100 d-inline-block"
                                                    placeholder="Nhập tin nhắn ở đây" required>
                                            </div>

                                            <div class="col-md-4">

                                                <button type="submit" class="btn btn-primary d-inline-block w-100"
                                                    style="    border-radius: 4px;"><i class="far fa-paper-plane"></i>
                                                    Gửi</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
