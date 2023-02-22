<?php

namespace App\Http\Livewire\Tenant;

use App\Models\Team;
use Livewire\Component;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ManageTeams extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    use LivewireAlert;
    
    public function render()
    {
        return view('livewire.tenant.manage-teams');
    }

    protected function getTableQuery() 
    {
        return Team::query();
    } 

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('users_count')->counts('users')->label('Members'),
            TextColumn::make('owner.name')
        ];
    }

    protected function getTableHeader()
    {
        return null;
    }

    protected function getTableHeading()
    {
        return 'My Teams';
    }
    

    // protected function getTableContentGrid(): ?array
    // {
    //     return [
    //         'md' => 2,
    //         'xl' => 3,
    //     ];
    // }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('view_invitations')
                    ->url( fn($record) => route('teams.invitations', $record->id) ),
                Action::make('invite_users')
                    ->form([
                        TagsInput::make('email')->placeholder('Input a valid email address')
                    ])
                    ->action(function(){

                    })
            ])
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            CreateAction::make('create')
                ->label('Create Team')
                ->form([
                    TextInput::make('name')->required(),
                    Textarea::make('description'),
                    Hidden::make('owner_id')
                ])
                ->mountUsing(fn (ComponentContainer $form, $record) => $form->fill([
                    'owner_id' => auth()->id(),
                ]))
                ->action(function(array $data){
                    $team = Team::create($data);
                    $team->users()->attach(auth()->id());

                    $this->alert('success', 'Team created successfully!');
                })
                ->color('primary')
                ->button()
        ];
    }

    protected function isTablePaginationEnabled(): bool 
    {
        return false;
    } 
}
