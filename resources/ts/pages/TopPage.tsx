import React from 'react';

const TopPage: React.FC = () => {
    return (
        <div style={styles.container}>
            <h1 style={styles.heading}>イベントスペースを探してみませんか？</h1>
            <p style={styles.paragraph}>
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
        width: '100vw',  // 幅を全画面に設定
        height: '100vh',  // 高さを全画面に設定
        backgroundColor: '#f9f9f9',
        boxSizing: 'border-box' as const,  // paddingやborderがサイズに影響しないように調整
        padding: 'clamp(20px, 5vw, 50px)',  // 画面のサイズに応じてpaddingを調整
    },
    heading: {
        fontSize: 'clamp(28px, 5vw, 72px)',  // 画面サイズに応じてフォントサイズを調整
        fontWeight: 'bold' as const,
        color: '#333',
        marginBottom: 'clamp(10px, 2vw, 20px)',  // 画面に応じてマージンを調整
    },
    paragraph: {
        fontSize: 'clamp(16px, 2.5vw, 36px)',  // 画面サイズに応じてフォントサイズを調整
        color: '#555',
        lineHeight: '1.6',
        maxWidth: '800px',
        textAlign: 'center' as const,
        margin: '0 auto',
    },
};

export default TopPage;
