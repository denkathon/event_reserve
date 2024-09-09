import React, { useEffect, useState } from 'react';

const VenuePage: React.FC = () => {
    const [venues, setVenues] = useState<any[]>([]); // 会場データを保持するステート

    // APIからデータを取得する
    useEffect(() => {
        fetch('http://localhost:8000/api/venues') // APIエンドポイントの呼び出し
            .then(response => response.json())
            .then(data => {
                console.log(data); // データをコンソールに表示
                setVenues(data); // データをステートにセット
            })
            .catch(error => console.error('Error fetching venues:', error));
    }, []); // []によりコンポーネントのマウント時に一度だけ実行

    return (
        <div>
            <h1>会場リスト</h1>
            <ul>
                {venues.length > 0 ? (
                    venues.map((venue) => (
                        <li key={venue.id}>{venue.name} - {venue.address}</li>
                    ))
                ) : (
                    <p>会場がありません。</p>
                )}
            </ul>
        </div>
    );
};

export default VenuePage;
