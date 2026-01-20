// ============================================================================
// HOMEPAGE.JS - Homepage Interactions
// ============================================================================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize toggle buttons
    initializeToggles();
    
    // Initialize search functionality
    initializeSearch();
    
    // Load sample news (replace with actual API call)
    loadSampleNews();
});

/**
 * Initialize all toggle buttons
 */
function initializeToggles() {
    const toggleButtons = document.querySelectorAll('[data-toggle]');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            toggleNav(this);
        });
    });
}

/**
 * Toggle navigation item expand/collapse
 */
function toggleNav(button) {
    const targetId = button.getAttribute('data-toggle');
    const target = document.getElementById(targetId);
    
    if (!target) return;
    
    // Check current state
    const isExpanded = button.getAttribute('data-expanded') === 'true';
    
    // Toggle state
    if (isExpanded) {
        collapseNav(button, target);
    } else {
        expandNav(button, target);
    }
}

/**
 * Expand navigation
 */
function expandNav(button, target) {
    button.setAttribute('data-expanded', 'true');
    target.setAttribute('data-expanded', 'true');
}

/**
 * Collapse navigation
 */
function collapseNav(button, target) {
    button.setAttribute('data-expanded', 'false');
    target.setAttribute('data-expanded', 'false');
}

/**
 * Expand all standards (optional utility)
 */
function expandAll() {
    const buttons = document.querySelectorAll('[data-toggle]');
    buttons.forEach(button => {
        const target = document.getElementById(button.getAttribute('data-toggle'));
        if (target) {
            expandNav(button, target);
        }
    });
}

/**
 * Collapse all standards (optional utility)
 */
function collapseAll() {
    const buttons = document.querySelectorAll('[data-toggle]');
    buttons.forEach(button => {
        const target = document.getElementById(button.getAttribute('data-toggle'));
        if (target) {
            collapseNav(button, target);
        }
    });
}

/**
 * Load sample news (replace with actual API call)
 */
function loadSampleNews() {
    const newsList = document.getElementById('news-list');
    
    const sampleNews = [
        {
            id: 1,
            title: 'Cập nhật hệ thống kiểm định chất lượng 2024',
            description: 'Công bố những tiêu chí mới trong quá trình kiểm định chất lượng cơ sở giáo dục năm 2024. Các tiêu chí này giúp nâng cao chất lượng giáo dục tại các cơ sở.',
            category: 'Cập nhật',
            author: 'Admin',
            date: '2024-01-15',
            tags: ['Kiểm định', 'Chất lượng']
        },
        {
            id: 2,
            title: 'Hướng dẫn nộp minh chứng kiểm định',
            description: 'Hướng dẫn chi tiết cách nộp minh chứng cho quá trình kiểm định chất lượng. Vui lòng tuân theo các bước hướng dẫn để đảm bảo hồ sơ của bạn hoàn chỉnh.',
            category: 'Hướng dẫn',
            author: 'Trưởng bộ phận',
            date: '2024-01-10',
            tags: ['Hướng dẫn', 'Minh chứng']
        },
        {
            id: 3,
            title: 'Kết quả kiểm định năm học 2023-2024',
            description: 'Công bố kết quả kiểm định chất lượng của tất cả các cơ sở giáo dục trong năm học 2023-2024. Các cơ sở được xếp hạng từ A đến D dựa trên kết quả kiểm định.',
            category: 'Kết quả',
            author: 'Ban lãnh đạo',
            date: '2024-01-05',
            tags: ['Kết quả', 'Đánh giá']
        }
    ];
    
    // Clear existing content except empty state message
    const emptyState = newsList.querySelector('.empty-state');
    if (emptyState) {
        emptyState.remove();
    }
    
    // Add sample news
    sampleNews.forEach(news => {
        const newsItem = createNewsItem(news);
        newsList.appendChild(newsItem);
    });
}

/**
 * Create news item element
 */
function createNewsItem(newsData) {
    const item = document.createElement('div');
    item.className = 'news-item';
    item.setAttribute('data-news-title', newsData.title.toLowerCase());
    item.setAttribute('data-news-desc', newsData.description.toLowerCase());
    
    const formattedDate = formatDate(newsData.date);
    
    item.innerHTML = `
        <div class="news-image">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="news-content">
            <div class="news-meta">
                <div class="news-meta-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>${formattedDate}</span>
                </div>
                <div class="news-meta-item">
                    <i class="fas fa-user"></i>
                    <span>${newsData.author}</span>
                </div>
            </div>
            <h3 class="news-title">${newsData.title}</h3>
            <p class="news-description">${newsData.description}</p>
            <div class="news-footer">
                <span class="news-tag">${newsData.category}</span>
                <a href="#" class="news-read-more">
                    Xem thêm
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    `;
    
    return item;
}

/**
 * Format date to Vietnamese format
 */
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric', timeZone: 'UTC' };
    return date.toLocaleDateString('vi-VN', options);
}

// ============================================================================
// SEARCH FUNCTIONALITY
// ============================================================================

/**
 * Initialize search functionality for news
 */
function initializeSearch() {
    const searchInput = document.getElementById('news-search');
    const clearBtn = document.querySelector('.search-clear');
    
    if (!searchInput) return;
    
    // Search on input
    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        
        // Show/hide clear button
        if (clearBtn) {
            clearBtn.style.display = query ? 'block' : 'none';
        }
        
        // Perform search
        filterNews(query);
    });
    
    // Clear search
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            if (clearBtn) clearBtn.style.display = 'none';
            filterNews('');
            searchInput.focus();
        });
    }
}

/**
 * Filter news based on search query
 */
function filterNews(query) {
    const newsItems = document.querySelectorAll('.news-item');
    let visibleCount = 0;
    
    newsItems.forEach(item => {
        const newsTitle = item.getAttribute('data-news-title') || '';
        const newsDesc = item.getAttribute('data-news-desc') || '';
        const searchText = (newsTitle + ' ' + newsDesc).toLowerCase();
        
        const isVisible = searchText.includes(query);
        
        if (isVisible) {
            item.classList.remove('hidden');
            visibleCount++;
        } else {
            item.classList.add('hidden');
        }
    });
    
    // Show/hide empty state
    const newsList = document.getElementById('news-list');
    let emptyState = newsList.querySelector('.empty-state');
    
    if (visibleCount === 0 && newsItems.length > 0) {
        // Create empty state if it doesn't exist
        if (!emptyState) {
            emptyState = document.createElement('div');
            emptyState.className = 'empty-state';
            emptyState.innerHTML = `
                <i class="fas fa-search"></i>
                <p>Không tìm thấy tin tức nào</p>
            `;
            newsList.appendChild(emptyState);
        }
        emptyState.style.display = 'flex';
    } else if (emptyState) {
        emptyState.style.display = 'none';
    }
}
