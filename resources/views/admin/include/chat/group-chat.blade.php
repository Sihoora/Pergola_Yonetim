@extends('admin.tema')

@section('css')

<style>
    .chat-container {
        display: flex;
        flex-direction: column;
        height: 600px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-image: url('{{ asset('admin/dist/img/chat_background.png') }}');
        background-size: cover;
        background-position: center;
    }
    
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        background-color: rgba(255, 255, 255, 0.8);
    }
    
    .message {
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.8);
    }
    
    .message-mine {
        background-color: rgba(220, 248, 198, 0.8);
        margin-left: 20%;
    }
    
    .message-other {
        background-color: rgba(255, 255, 255, 0.8);
        margin-right: 20%;
    }
    
    .message-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
    }
    
    .chat-input {
    padding: 1rem;
    border-top: 1px solid #ddd;
    background-color: rgba(255, 255, 255, 0.9);
    position: relative;
    }

.input-group {
    display: flex;
    gap: 0.5rem;
}

.users-list {
    position: absolute;
    top: auto; /* top: -200px yerine */
    bottom: 100%; /* Input'un altında konumlandırma */
    left: 16px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 -4px 12px rgba(0,0,0,0.15);
    max-height: 200px;
    overflow-y: auto;
    width: calc(100% - 100px);
    z-index: 9999;
    display: none;
    margin-bottom: 8px; /* Input ile liste arasında boşluk */
}

.users-list.visible {
    display: block; /* Görünür olduğunda */
}

.user-item {
    padding: 10px 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    border-bottom: 1px solid #eee;
}

.user-item:last-child {
    border-bottom: none;
}

.user-item:hover,
.user-item.selected {
    background-color: #f5f5f5;
}
    .mentioned-user {
        color: #2196f3;
        font-weight: 500;
        background-color: rgba(33, 150, 243, 0.1);
        padding: 2px 4px;
        border-radius: 4px;
    }
    </style>



@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
@endsection

@section('master')
<div class="container-fluid">
    @livewire('chat-component')
</div>
@endsection

@section('js')
@livewireScripts




<script>
document.addEventListener('livewire:load', function () {
    let chatInput = document.querySelector('input[wire\\:model\\.defer="message"]');
    let component = window.Livewire.find(
        document.querySelector('[wire\\:id]').getAttribute('wire:id')
    );
    
    let usersList = null;
    let currentMentionStart = -1;
    let isUserListVisible = false;
    let mentionInProgress = false;
    
    function initializeUsersList() {
        if (!usersList) {
            usersList = document.createElement('div');
            usersList.className = 'users-list';
            document.querySelector('.chat-input').appendChild(usersList);
            console.log('Users list initialized');
        }
    }
    
    initializeUsersList();
    
    async function handleMentionInput(inputElement) {
        const cursorPosition = inputElement.selectionStart;
        const textBeforeCursor = inputElement.value.substring(0, cursorPosition);
        const lastAtSymbol = textBeforeCursor.lastIndexOf('@');
        
        if (lastAtSymbol !== -1) {
            const searchText = textBeforeCursor.substring(lastAtSymbol + 1);
            currentMentionStart = lastAtSymbol;
            mentionInProgress = true;
            
            try {
                const users = await component.call('getUsersList', searchText);
                
                if (users && users.length > 0 && mentionInProgress) {
                    showUsersList(users);
                    isUserListVisible = true;
                } else {
                    hideUsersList();
                }
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        } else {
            hideUsersList();
        }
    }
    
    function showUsersList(users) {
        if (!usersList) initializeUsersList();
        
        usersList.innerHTML = users.map((user, index) => `
            <div class="user-item ${index === 0 ? 'selected' : ''}" 
                 data-user-id="${user.id}" 
                 data-user-name="${user.name}">
                ${user.name}
            </div>
        `).join('');
        
        positionUsersList();
        usersList.classList.add('visible');
        addUserClickListeners();
    }
    
    function positionUsersList() {
    if (!usersList || !chatInput) return;
    
    const inputRect = chatInput.getBoundingClientRect();
    const chatInputContainer = document.querySelector('.chat-input');
    
    usersList.style.position = 'absolute';
    usersList.style.bottom = '100%';
    usersList.style.left = '16px';
    usersList.style.width = `${inputRect.width - 100}px`;
}
    
function selectUser(userItem) {
    const userId = userItem.dataset.userId;
    const userName = userItem.dataset.userName;
    
    const beforeMention = chatInput.value.substring(0, currentMentionStart);
    const afterMention = chatInput.value.substring(chatInput.selectionStart);
    
    // Boşluk eklemeyi sadece cümle sonunda yap
    const isEndOfInput = chatInput.selectionStart === chatInput.value.length;
    const newValue = `${beforeMention}@${userName}${isEndOfInput ? ' ' : ''}${afterMention}`;
    chatInput.value = newValue;
    
    // Livewire modelini güncelle
    component.set('message', newValue);
    
    // İmleci mention'dan sonraya konumlandır
    const newCursorPosition = currentMentionStart + userName.length + 1 + (isEndOfInput ? 1 : 0);
    chatInput.setSelectionRange(newCursorPosition, newCursorPosition);
    
    mentionInProgress = false;
    hideUsersList();
    chatInput.focus();
}
    
    function hideUsersList() {
        if (usersList) {
            usersList.classList.remove('visible');
            isUserListVisible = false;
            if (!mentionInProgress) {
                currentMentionStart = -1;
            }
        }
    }
    
    let inputTimeout;
    chatInput.addEventListener('input', function(e) {
        clearTimeout(inputTimeout);
        inputTimeout = setTimeout(() => handleMentionInput(this), 100);
    });
    
    chatInput.addEventListener('keydown', function(e) {
        if (!isUserListVisible) return;
        
        if (e.key === 'Enter' && usersList.classList.contains('visible')) {
            e.preventDefault();
            const selectedUser = usersList.querySelector('.user-item.selected');
            if (selectedUser) {
                selectUser(selectedUser);
            }
        } else if (e.key === 'Escape') {
            mentionInProgress = false;
            hideUsersList();
        } else if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();
            navigateUsersList(e.key === 'ArrowDown');
        }
    });
    
    function addUserClickListeners() {
        usersList.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', function() {
                selectUser(this);
            });
            
            item.addEventListener('mouseover', function() {
                usersList.querySelectorAll('.user-item.selected').forEach(el => 
                    el.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    }
    
    function navigateUsersList(moveDown) {
        const items = Array.from(usersList.querySelectorAll('.user-item'));
        const currentIndex = items.findIndex(item => item.classList.contains('selected'));
        items[currentIndex]?.classList.remove('selected');
        
        let nextIndex;
        if (moveDown) {
            nextIndex = currentIndex < items.length - 1 ? currentIndex + 1 : 0;
        } else {
            nextIndex = currentIndex > 0 ? currentIndex - 1 : items.length - 1;
        }
        
        items[nextIndex].classList.add('selected');
        items[nextIndex].scrollIntoView({ block: 'nearest' });
    }
    
    document.addEventListener('click', function(e) {
        if (usersList && !usersList.contains(e.target) && e.target !== chatInput) {
            mentionInProgress = false;
            hideUsersList();
        }
    });
    
    window.addEventListener('resize', positionUsersList);
});
</script>


@endsection