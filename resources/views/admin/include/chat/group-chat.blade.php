@extends('admin.tema')

@section('css')

<style>

 /* Sayfa ortalama için body düzenlemeleri */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Sayfanın tamamını kaplaması için */
    margin: 0;
    background-color: #f0f2f5; /* Chat arka planı ile uyumlu bir arka plan rengi */
}

.chat-container {
    display: flex;
    flex-direction: column;
    width: 100vh; /* Genişlik, ekranın %80'i olacak şekilde ayarlandı */
    height: 85vh; /* Yüksekliği ekranın %80’i olacak şekilde ayarlandı */
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f4f6f9;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
    background-color: #ffffff;
    opacity: 0.95; /* Opaklık ile daha yumuşak bir görünüm */
    border-bottom: 1px solid #ddd;
}

.message {
    margin-bottom: 1rem;
    padding: 0.75rem;
    border-radius: 10px;
    font-size: 0.9rem;
    line-height: 1.5;
}

.message-mine {
    background-color: #e1ffc7;
    align-self: flex-end;
    margin-left: auto;
}

.message-other {
    background-color: #f1f1f1;
    align-self: flex-start;
    margin-right: auto;
}

.message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.25rem;
    font-size: 0.75rem;
    color: #666;
}

.chat-input {
    padding: 1rem;
    border-top: 1px solid #ddd;
    background-color: rgba(255, 255, 255, 0.9);
    height: 80px; /* Input kısmının yüksekliğini artırdık */
    display: flex; /* Flex yapısıyla daha iyi hizalama */
    align-items: center;
    gap: 0.5rem; /* Buton ve input arasındaki boşluk */
}

.chat-input input[type="text"] {
    flex: 1; /* Input'un genişliğini esnetir */
    flex-grow: 1;
    padding: 0.75rem;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.chat-input button {
    padding: 0.5rem 1rem;
    border-radius: 0px 20px 20px 0px;
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.chat-input button:hover {
    background-color: #45a049;
}

.users-list {
    position: absolute;
    bottom: 100%;
    left: 10px;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    max-height: 200px;
    overflow-y: auto;
    width: calc(100% - 80px);
    z-index: 10;
    display: none;
}

.user-item {
    padding: 8px;
    cursor: pointer;
    transition: all 0.2s;
    border-bottom: 1px solid #f1f1f1;
}

.user-item:hover,
.user-item.selected {
    background-color: #f0f8ff;
}


    /* Mention edilmiş kullanıcı vurgusu */
    .mentioned-user {
        color: #1e88e5;
        font-weight: 500;
        background-color: rgba(30, 136, 229, 0.1);
        padding: 2px 6px;
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

document.addEventListener('DOMContentLoaded', function () {
    const chatMessages = document.querySelector('.chat-messages');

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Sayfa yüklendiğinde en alta kaydır
    scrollToBottom();

    // Yeni mesaj geldiğinde en alta kaydır
    chatMessages.addEventListener('DOMNodeInserted', scrollToBottom);

        // Mesaj gönderildiğinde de en alta kaydır
        document.querySelector('.chat-input').addEventListener('submit', function (e) {
        e.preventDefault();
        // Mesaj gönderildikten sonra en alta kaydır
        setTimeout(scrollToBottom, 100); // Biraz gecikmeyle çalıştır, yeni mesaj eklendiğinde kayar
    });
});
</script>


@endsection