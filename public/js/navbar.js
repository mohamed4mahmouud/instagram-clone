
            // Handle search dynamically On letter adding 
            let searchUsers = document.getElementById('Username')
            searchUsers.oninput = async function() {
                const searchString = this.value;
                if (searchString) {
                    const url = 'http://localhost:8000/users/' + searchString;
                    const res = await fetch(url);
                    const data = await res.json();
                    document.getElementById('Searchresult').innerHTML = '';
                    
                    //Card place holder till data is retrieved
                    document.getElementById('Searchresult').innerHTML = `
                
                    <p class="card-text placeholder-glow">
                        
                        <span class="placeholder custom rounded-circle col-8"></span>
                        <span class="placeholder mt-3 mb-1 col-8"></span>
                        <span class="placeholder mb-5 col-4"></span><br>
                        <span class="placeholder custom rounded-circle col-8"></span>
                        <span class="placeholder mt-3 mb-1 col-8"></span>
                        <span class="placeholder mb-5 col-4"></span><br>
                        <span class="placeholder custom rounded-circle col-8"></span>
                        <span class="placeholder mt-3 mb-1 col-8"></span>
                        <span class="placeholder mb-5 col-4"></span><br>
                        <span class="placeholder custom rounded-circle col-8"></span>
                        <span class="placeholder mt-3 mb-1 col-8"></span>
                        <span class="placeholder mb-5 col-4"></span><br>
                        <span class="placeholder custom rounded-circle col-8"></span>
                        <span class="placeholder mt-3 mb-1 col-8"></span>
                        <span class="placeholder mb-5 col-4"></span><br>

                    </p>`;
                    console.log(data);
                    for (let i = 0; i < data.users.length; i++) {
                        const user = data.users[i];
                        if (i==0) {
                            document.getElementById('Searchresult').innerHTML='';
                        }
                        document.getElementById('Searchresult').innerHTML+=`
                        <div class="card bg-dark text-white">
                            <a class="profile-link d-flex" href="/profile/${user.id}">
                                <div class="card-body row">
                                    <div class="story me-5">
                                        <img src="http://localhost:8000/storage/${user.avatar}" class="rounded-circle"
                                        height="60" alt="avatar" />
                                    </div>
                                    <div class="col-8">
                                        <div class="row">${user.userName}<div>
                                                <small class="col-4 text-secondary">${user.fullName}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `
                        
                    }
                }

            }