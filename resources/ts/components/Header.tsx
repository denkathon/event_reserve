import React, { useEffect, useRef } from 'react';

const Header: React.FC = () => {
    const headerRef = useRef<HTMLElement>(null);

    const updatePaddingTop = () => {
        if (headerRef.current) {
            const headerHeight = headerRef.current.offsetHeight;
            document.body.style.paddingTop = `${headerHeight}px`;  // ヘッダーの高さ分だけ余白を設定
        }
    };

    useEffect(() => {
        updatePaddingTop();

        window.addEventListener('resize', updatePaddingTop);

        return () => {
            window.removeEventListener('resize', updatePaddingTop);
        };
    }, []);

    return (
        <header ref={headerRef} style={{ 
            backgroundColor: '#fff', 
            padding: 'clamp(5px, 1vw, 10px) 0',  // ヘッダーの上下パディングをさらに小さく設定
            color: '#000', 
            borderBottom: '2px solid #000', 
            width: '100%', 
            position: 'fixed', 
            top: 0, 
            left: 0, 
            zIndex: 1000 
        }}>
            <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet" />
            <nav style={{ 
                display: 'flex', 
                justifyContent: 'space-between',  // リスト項目を均等に配置
                alignItems: 'center', 
                width: '100%', 
                padding: '0 clamp(5px, 2vw, 20px)',  // ナビゲーションの左右パディングも調整
                overflow: 'hidden'  // ナビゲーションバーが画面外に出ないように制限
            }}>
                <h1 style={{ 
                    margin: 0, 
                    fontFamily: 'Dancing Script, sans-serif', 
                    fontSize: 'clamp(28px, 5vw, 56px)',  // フォントサイズを少し小さく設定
                    textShadow: '2px 2px 4px rgba(0, 0, 0, 0.3)' 
                }}>
                    KawagoeLive
                </h1>
                <ul style={{ 
                    display: 'flex', 
                    listStyle: 'none', 
                    margin: 0, 
                    padding: 0, 
                    gap: 'clamp(10px, 2vw, 100px)',  // gapをさらに小さく調整
                    marginLeft: 'auto',  // リストを右寄せに設定
                    whiteSpace: 'nowrap',  // 文字が折り返されないように設定
                    overflow: 'hidden',  // リストが画面外に出ないように制限
                    flexShrink: 1  // リストが縮小するように設定
                }}>
                    <li style={{ flexShrink: 1, minWidth: '100px' }}><a href="/mypage" style={{ color: '#000', textDecoration: 'none', fontSize: 'clamp(14px, 2.5vw, 36px)' }}>マイページ</a></li>
                    <li style={{ flexShrink: 1, minWidth: '150px' }}><a href="/eventspaces" style={{ color: '#000', textDecoration: 'none', fontSize: 'clamp(14px, 2.5vw, 36px)' }}>イベントスペース一覧</a></li>
                    <li style={{ flexShrink: 1, minWidth: '120px' }}><a href="/events" style={{ color: '#000', textDecoration: 'none', fontSize: 'clamp(14px, 2.5vw, 36px)' }}>イベント一覧</a></li>
                </ul>
            </nav>
        </header>
    );
};

export default Header;
