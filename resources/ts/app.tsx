import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import TopPage from './pages/TopPage';  // トップページのコンポーネント
import Header from './components/Header';  // ヘッダーコンポーネント

// RouteContentsはルーティングの設定を持つコンポーネント
const RouteContents = () => {
    return (
        <Routes>
            <Route path="/" element={<TopPage />} /> {/* トップページ */}
            {/* ここに他のルートも追加できます */}
        </Routes>
    );
}

// Appコンポーネントでルーティングとレイアウトを設定
function App() {
    return (
        <Router>
            <div>
                <Header />  {/* ヘッダーを全ページで表示 */}
                <RouteContents />  {/* ページコンテンツ */}
            </div>
        </Router>
    );
}

// root要素にAppコンポーネントをレンダリング
const root = ReactDOM.createRoot(document.getElementById('app')!);
root.render(<App />);
