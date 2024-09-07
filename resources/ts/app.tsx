import React from 'react';
import ReactDOM from 'react-dom/client';
//import Example from './components/Example';
import TopPage from './pages/TopPage'; 
import Header from './components/Header';  // 新しく作成したHeaderコンポーネント

const rootElement = document.getElementById('app');

//if (rootElement) {
//    ReactDOM.createRoot(rootElement).render(<TopPage />);//toppageに変えました
//}

if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        <div>
            <Header />  {/* ヘッダーをページ上部に表示 */}
            <TopPage />  {/* トップページの内容を表示 */}
        </div>
    );
}