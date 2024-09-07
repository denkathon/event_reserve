import React, { useState } from 'react';

// モーダルコンポーネント
const Modal: React.FC<{
    isOpen: boolean,
    onClose: () => void,
    venue: string,
    customStyles?: {
        modalOverlay?: React.CSSProperties,
        modalContent?: React.CSSProperties,
        closeButton?: React.CSSProperties,
    }
}> = ({ isOpen, onClose, venue, customStyles = {} }) => {
    if (!isOpen) return null;

    return (
        <div style={{ ...styles.modalOverlay, ...customStyles.modalOverlay }}>
            <div style={{ ...styles.modalContent, ...customStyles.modalContent }}>
                <h2>{venue} の詳細情報</h2>
                <p>{venue}に関する説明や詳細情報がここに表示されます。</p>
                <button onClick={onClose} style={{ ...styles.closeButton, ...customStyles.closeButton }}>
                    閉じる
                </button>
            </div>
        </div>
    );
};

const EventSpaceList: React.FC = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [selectedVenue, setSelectedVenue] = useState<string | null>(null);
    const [activeItem, setActiveItem] = useState<string | null>(null);

    // モーダルを開く関数
    const openModal = (venue: string) => {
        setSelectedVenue(venue);
        setIsModalOpen(true);
    };

    // モーダルを閉じる関数
    const closeModal = () => {
        setIsModalOpen(false);
        setSelectedVenue(null);
    };

    // イベントアイテムをクリックした際のスタイル変更
    const handleMouseDown = (venue: string) => {
        setActiveItem(venue);
    };

    const handleMouseUp = () => {
        setActiveItem(null);
    };

    return (
        <div style={styles.container}>
            <h2 style={styles.title}>イベントスペース一覧</h2>
            <div style={styles.eventList}>
                {/* 会場1 */}
                <div
                    style={{
                        ...styles.eventItem,
                        ...(activeItem === '会場1' ? styles.eventItemActive : {}),
                    }}
                    onMouseDown={() => handleMouseDown('会場1')}
                    onMouseUp={handleMouseUp}
                    onClick={() => openModal('会場1')}
                >
                    <div style={styles.circle}></div>
                    <div style={styles.infoBox}>会場1 埼玉県川越市元町1丁目3番地1</div>
                </div>
                {/* 会場2 */}
                <div
                    style={{
                        ...styles.eventItem,
                        ...(activeItem === '会場2' ? styles.eventItemActive : {}),
                    }}
                    onMouseDown={() => handleMouseDown('会場2')}
                    onMouseUp={handleMouseUp}
                    onClick={() => openModal('会場2')}
                >
                    <div style={styles.circle}></div>
                    <div style={styles.infoBox}>会場2 2024/xx/xx/xx:xx</div>
                </div>
                {/* 会場3 */}
                <div
                    style={{
                        ...styles.eventItem,
                        ...(activeItem === '会場3' ? styles.eventItemActive : {}),
                    }}
                    onMouseDown={() => handleMouseDown('会場3')}
                    onMouseUp={handleMouseUp}
                    onClick={() => openModal('会場3')}
                >
                    <div style={styles.circle}></div>
                    <div style={styles.infoBox}>会場3 2024/xx/xx/xx:xx</div>
                </div>
            </div>

            {/* モーダル */}
            <Modal 
                isOpen={isModalOpen} 
                onClose={closeModal} 
                venue={selectedVenue || ''} 
                customStyles={{
                    modalContent: {
                        backgroundColor: '#f0f0f0', // ここでスタイルを上書きできる
                    }
                }} 
            />
        </div>
    );
};

// CSSスタイル
const styles = {
    container: {
        display: 'flex',
        flexDirection: 'column' as const,
        justifyContent: 'center',
        alignItems: 'center',
        width: '100vw',
        height: '100vh',
        padding: 'clamp(20px, 5vw, 50px)',
        boxSizing: 'border-box' as const,
        backgroundColor: '#f9f9f9',
    },
    title: {
        fontSize: 'clamp(24px, 5vw, 48px)',
        borderBottom: '2px solid black',
        marginBottom: 'clamp(10px, 2vw, 20px)',
        textAlign: 'center' as const,
    },
    eventList: {
        display: 'flex',
        flexDirection: 'column' as const,
        gap: 'clamp(10px, 2vw, 30px)',
        width: '100%',
        maxWidth: '1200px',
    },
    eventItem: {
        display: 'flex',
        alignItems: 'center',
        padding: 'clamp(10px, 2vw, 20px)',
        borderRadius: '15px',
        border: '2px solid #ccc',
        backgroundColor: '#f9f9f9',
        width: '100%',
        cursor: 'pointer',
        transition: 'background-color 0.3s ease, transform 0.1s ease',
    },
    eventItemActive: {
        backgroundColor: '#ececec',
        transform: 'scale(0.98)',  // 押したときに少し縮む
    },
    circle: {
        width: 'clamp(30px, 5vw, 50px)',
        height: 'clamp(30px, 5vw, 50px)',
        borderRadius: '50%',
        backgroundColor: '#000',
        marginRight: 'clamp(10px, 2vw, 20px)',
    },
    infoBox: {
        flexGrow: 1,
        padding: 'clamp(10px, 2vw, 20px)',
        border: '1px solid #000',
        borderRadius: '10px',
        fontSize: 'clamp(16px, 2.5vw, 24px)',
    },
    modalOverlay: {
        position: 'fixed' as const,
        top: 0,
        left: 0,
        right: 0,
        bottom: 0,
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
    },
    modalContent: {
        backgroundColor: '#fff',
        padding: 'clamp(20px, 4vw, 30px)',
        borderRadius: '10px',
        maxWidth: '500px',
        width: '100%',
        textAlign: 'center' as const,
    },
    closeButton: {
        marginTop: 'clamp(10px, 2vw, 20px)',
        padding: 'clamp(5px, 1.5vw, 10px) clamp(10px, 3vw, 20px)',
        backgroundColor: '#000',
        color: '#fff',
        border: 'none',
        cursor: 'pointer',
        borderRadius: '5px',
    },
};

export default EventSpaceList;
