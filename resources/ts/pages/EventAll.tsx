import React, { useState, useEffect } from 'react';

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

const EventList: React.FC = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [selectedVenue, setSelectedVenue] = useState<string | null>(null);
    const [activeItem, setActiveItem] = useState<string | null>(null);

    // イベントデータの状態を管理するためのstate
    const [events, setEvents] = useState<{ id: string, name: string, info: string }[]>([]);

    // コンポーネントがマウントされたときにデータを取得
    useEffect(() => {
        fetch('/api/events') // LaravelのAPIエンドポイント
            .then(response => response.json())
            .then(data => {
                // データをStateに保存
                console.log("取得したデータ:", data);
                setEvents(data);
            })
            .catch(error => {
                console.error('データ取得に失敗しました:', error);
            });
    }, []);

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
            <h2 style={styles.title}>イベント一覧</h2>
            <div style={styles.eventList}>
                {events.map(event => (
                    <div
                        key={event.id}
                        style={{
                            ...styles.eventItem,
                            ...(activeItem === event.name ? styles.eventItemActive : {}),
                        }}
                        onMouseDown={() => handleMouseDown(event.name)}
                        onMouseUp={handleMouseUp}
                        onClick={() => openModal(event.name)}
                    >
                        <div style={styles.circle}></div>
                        <div style={styles.infoBox}>{event.name} - {event.info}</div>
                    </div>
                ))}
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

// スタイルオブジェクト
const styles = {
    container: {
        padding: '20px',
    },
    title: {
        fontSize: '24px',
        marginBottom: '20px',
    },
    eventList: {
        display: 'flex',
        flexDirection: 'column',
        gap: '10px',
    },
    eventItem: {
        display: 'flex',
        alignItems: 'center',
        padding: '10px',
        backgroundColor: '#fff',
        border: '1px solid #ccc',
        borderRadius: '5px',
        cursor: 'pointer',
    },
    eventItemActive: {
        backgroundColor: '#e0e0e0',
    },
    circle: {
        width: '20px',
        height: '20px',
        backgroundColor: '#000',
        borderRadius: '50%',
        marginRight: '10px',
    },
    infoBox: {
        fontSize: '16px',
    },
    modalOverlay: {
        position: 'fixed' as 'fixed',
        top: 0,
        left: 0,
        width: '100%',
        height: '100%',
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
    },
    modalContent: {
        backgroundColor: '#fff',
        padding: '20px',
        borderRadius: '10px',
        width: '400px',
    },
    closeButton: {
        marginTop: '20px',
        padding: '10px 20px',
        cursor: 'pointer',
    },
};

export default EventList;
