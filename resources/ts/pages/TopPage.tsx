import React, { useEffect, useState } from 'react';

const TopPage: React.FC = () => {
    const [isVisible, setIsVisible] = useState(false);

    useEffect(() => {
        // ページが開かれたときにアニメーションを開始
        setTimeout(() => {
            setIsVisible(true);
        }, 200); // 200ミリ秒後にアニメーション開始
    }, []);

    return (
        <div style={styles.container}>
            <h1 style={{ ...styles.heading, opacity: isVisible ? 1 : 0, transform: isVisible ? 'translateY(0)' : 'translateY(20px)' }}>
                イベントスペースを探してみませんか？
            </h1>
            <p style={{ ...styles.paragraph, opacity: isVisible ? 1 : 0, transform: isVisible ? 'translateY(0)' : 'translateY(20px)' }}>
                当サイトでは、利用可能なイベントスペースの一覧を提供しています。各スペースの詳細情報を確認し、予約フォームから簡単に予約できます。
            </p>
        </div>
    );
};

const styles = {
    container: {
        display: 'flex',
        flexDirection: 'column' as const,
        justifyContent: 'center',
        alignItems: 'center',
        width: '100vw',  
        height: '100vh',  
        backgroundColor: '#f9f9f9',
        boxSizing: 'border-box' as const,
        padding: 'clamp(20px, 5vw, 50px)',
    },
    heading: {
        fontSize: 'clamp(28px, 5vw, 72px)',
        fontWeight: 'bold' as const,
        color: '#333',
        marginBottom: 'clamp(10px, 2vw, 20px)',
        transition: 'opacity 1.8s ease-out, transform 1.8s ease-out',
    },
    paragraph: {
        fontSize: 'clamp(16px, 2.5vw, 36px)',
        color: '#555',
        lineHeight: '1.6',
        maxWidth: '800px',
        textAlign: 'center' as const,
        margin: '0 auto',
        transition: 'opacity 1.8s ease-out, transform 1.8s ease-out',
    },
};

export default TopPage;
