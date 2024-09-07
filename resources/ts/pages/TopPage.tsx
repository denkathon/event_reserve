import React from 'react';

const TopPage: React.FC = () => {
    return (
        <div className="container">
            <h1>イベントスペースを探してみませんか？</h1>
            <p>
                当サイトでは、利用可能なイベントスペースの一覧を提供しています。各スペースの詳細情報を確認し、予約フォームから簡単に予約できます。
            </p>
            <button onClick={() => window.location.href = '/events'}>イベントスペース一覧</button>
        </div>
    );
};

export default TopPage;
