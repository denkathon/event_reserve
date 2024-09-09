import React, { useEffect, useState } from 'react';
import { useZxing } from "react-zxing";
import { Result } from '@zxing/library';
import axios from 'axios';

// モーダルコンポーネント
const Modal: React.FC<{ onClose: () => void; title: string; content: string }> = ({ onClose, title, content }) => {
    const [result, setResult] = useState('');
    const [showScanner, setShowScanner] = useState(false);

    const { ref } = useZxing({
        onDecodeResult(decodedResult: Result) {
            setResult(decodedResult.getText());
            setShowScanner(false);
        },
        onError(error) {
            console.error("QRコードのスキャン中にエラーが発生しました:", error);
        },
    });

    return (
    <div style={styles.modalOverlay}>
        <div style={styles.modalContent}>
        <h2>{title}</h2>
        <p>{content}</p>
        {!showScanner ? (
            <>
            <button onClick={() => setShowScanner(true)} style={styles.button}>QRコードをスキャン</button>
            {result && <p>スキャン結果: {result}</p>}
            </>
        ) : (
            <div style={styles.scannerContainer}>
            <video ref={ref} style={styles.scanner} />
            </div>
        )}
        <button onClick={onClose} style={styles.closeButton}>閉じる</button>
        </div>
    </div>
    );
};

const Mypagelist: React.FC = () => {
    const [selectedItem, setSelectedItem] = useState<string | null>(null);
    const [hoveredItem, setHoveredItem] = useState<string | null>(null);
    const [selectedTab, setSelectedTab] = useState('貸出予約');
    const [reservations, setReservations] = useState([
    { id: 1, type: '貸出予約', details: '名前とか詳細な情報、日時' },
    { id: 2, type: '参加予約', details: '名前とか詳細な情報、日時' },
    ]);
    const [showModal, setShowModal] = useState(false);
    const [modalContent, setModalContent] = useState({ title: '', content: '' });

    const handleSelect = (item: string) => {
        setSelectedItem(item);
    };

    const addReservation = () => {
        const newReservation = { id: Date.now(), type: selectedTab, details: '新しい予約の詳細' };
        setReservations([...reservations, newReservation]);
    };

    const deleteReservation = (id: number) => {
        setReservations(reservations.filter(reservation => reservation.id !== id));
    };

    const handleShowModal = (details: string) => {
        setModalContent({ title: '予約詳細', content: details });
        setShowModal(true);
    };

    // const reservationButtons = [
    //     "予約1の詳細",
    //     "予約2の詳細",
    //     "予約3の詳細",
    //     "予約4の詳細",
    //     "予約5の詳細",
    //     "予約6の詳細",
    //     "予約7の詳細",
    //     "予約8の詳細",
    //     // 必要に応じて予約ボタンを追加
    // ];

    const handleReservationClick = (button: string) => {
        setModalContent({
            title: button,
            content: `これは${button}の内容です。実際のアプリケーションでは、ここに予約の詳細情報が表示されます。`
        });
        setShowModal(true);
    };

    const renderRightPanelContent = () => {
        switch (selectedItem) {
            case 'A':
                return (
                    <>
                        <div style={styles.tabContainer}>
                            <span
                            style={selectedTab === '貸出予約' ? styles.activeTab : styles.tab}
                            onClick={() => setSelectedTab('貸出予約')}
                            >
                            貸出予約
                            </span>
                            <span
                            style={selectedTab === '参加予約' ? styles.activeTab : styles.tab}
                            onClick={() => setSelectedTab('参加予約')}
                            >
                            参加予約
                            </span>
                        </div>

                        <button onClick={addReservation} style={styles.addButton}>予約を追加</button>

                        <div style={styles.reservationContainer}>
                            {reservations
                            .filter(reservation => reservation.type === selectedTab)
                            .map((reservation) => (
                                <div key={reservation.id} style={styles.reservation}>
                                <div style={styles.image}>Image</div>
                                <div style={styles.details}>{reservation.details}</div>
                                <button style={styles.deleteButton} onClick={() => handleShowModal(reservation.details)}>詳細</button>
                                <button style={styles.deleteButton} onClick={() => deleteReservation(reservation.id)}>削除</button>
                                </div>
                            ))}
                        </div>
                    </>
                );
            case 'B':
                return (
                    <>
                        <h3>キャンセル済み・過去の予約</h3>
                        <p>キャンセル済みや過去の予約に関する情報がここに表示されます。</p>
                        <button onClick={() => console.log('過去の予約のアクション')}>履歴を確認</button>
                    </>
                );
            case 'C':
                return (
                    <>
                        <h3>お気に入り</h3>
                        <p>お気に入りのスペースや施設がここに表示されます。</p>
                        <button onClick={() => console.log('お気に入りのアクション')}>お気に入りを管理</button>
                    </>
                );
            case 'D':
                return (
                    <>
                        <h3>クーポン一覧</h3>
                        <p>利用可能なクーポンの一覧がここに表示されます。</p>
                        <button onClick={() => console.log('クーポンのアクション')}>クーポンを使用</button>
                    </>
                );
            case 'E':
                return (
                    <>
                        <h3>アカウント設定</h3>
                        <p>アカウント設定の詳細がここに表示されます。</p>
                        <button onClick={() => console.log('アカウント設定のアクション')}>設定を変更</button>
                    </>
                );
            case 'F':
                return (
                    <>
                        <h3>管理者</h3>
                        <p>管理者向けの情報や機能がここに表示されます。</p>
                        <button onClick={() => console.log('管理者のアクション')}>管理画面へ</button>
                    </>
                );
            default:
                return <p>左側のメニューから項目を選択してください。</p>;
        }
    };

    return (
        <div>
            <h2 style={styles.mypage_title}>マイページ</h2>

            <div style={styles.container}>
                <div style={styles.leftPanel}>
                    <ul style={styles.ul}>
                        {['A', 'B', 'C', 'D', 'E', 'F'].map((item, index) => (
                            <li
                                key={index}
                                style={{
                                    ...styles.list,
                                    ...(hoveredItem === item ? styles.listItemHover : {}),
                                    ...(selectedItem === item ? styles.listItemSelected : {}),
                                }}
                                onClick={() => handleSelect(item)}
                                onMouseEnter={() => setHoveredItem(item)}
                                onMouseLeave={() => setHoveredItem(null)}
                            >
                                {item === 'A' && '現在の予約'}
                                {item === 'B' && 'キャンセル済み・過去の予約'}
                                {item === 'C' && 'お気に入り'}
                                {item === 'D' && 'クーポン一覧'}
                                {item === 'E' && 'アカウント設定'}
                                {item === 'F' && '管理者'}
                            </li>
                        ))}
                    </ul>
                </div>

                <div style={styles.rightPanel}>
                    {renderRightPanelContent()}
                </div>
            </div>
            {showModal && (
                <Modal 
                    onClose={() => setShowModal(false)} 
                    title={modalContent.title} 
                    content={modalContent.content}
                />
            )}
        </div>
    );
};

const styles = {
    mypage_title: {
        // textAlign: 'left' as const,
        position: 'relative' as const, 
        padding: '20px',
        fontSize: '35px',
        fontWeight: 'bold',
        marginBottom: '10px',
        borderBottom: '2px solid #000'
    },
    container: {
        display: 'flex',
        height: '100vh', /* 全画面の高さに対応 */
    },
    tabContainer: {
        display: 'flex',
        justifyContent: 'center'as const, /* 中央に配置 */
        marginBottom: '20px',
    },
    tab: {
        cursor: 'pointer',
        padding: '10px 20px',
        borderBottom: '2px solid transparent',
        color: '#ccc',
    },
    activeTab: {
        cursor: 'pointer',
        padding: '10px 20px',
        borderBottom: '2px solid black',
        fontWeight: 'bold',
    },
    addButton: {
        marginBottom: '20px',
        padding: '10px 20px',
        backgroundColor: '#4CAF50',
        color: 'white',
        border: 'none',
        borderRadius: '5px',
        cursor: 'pointer',
    },
    leftPanel: {
        width: '50%',
        backgroundColor: 'white', 
        padding: '20px',
        paddingLeft: '40px',
        borderRight: '1px solid #ccc', 
    },
    rightPanel: {
        width: '50%', /* 右側の幅 */
        padding: '20px',
    },
    ul: {
        listStyle: 'none',
        padding: '0',
        width: '100%',
    },
    list: {
        margin: '10px 0',
        cursor: 'pointer',
        padding: '15px',
        backgroundColor: 'white' as const,
        border: 'none',
        textAlign: 'left' as const,
        width: '100%',
        boxSizing: 'border-box'as const,
        fontSize: '30px',  
    },
    listItemHover: {
        color: '#1B85FB',
    },

    

    listItemSelected: {
        backgroundColor: '#aaa',
        fontWeight: 'bold' as const,
    },
    scrollableContainer: {
        height: '500px',
        overflowY: 'auto' as const,
        display: 'flex',
        flexDirection: 'column' as const,
        gap: '10px',
        padding: '10px',
    },
    reservationContainer: {
        border: '1px solid #ccc',
        borderRadius: '5px',
        padding: '10px',
    },
    reservation: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        border: '1px solid #ccc',
        borderRadius: '5px',
        padding: '10px',
        marginBottom: '10px',
    },
    image: {
        width: '50px',
        height: '50px',
        backgroundColor: '#eee',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        borderRadius: '5px',
    },
    details: {
        flex: 1,
        marginLeft: '10px',
    },
    deleteButton: {
        color: '#007BFF',
        background: 'none',
        border: 'none',
        cursor: 'pointer',
    },
    modalOverlay: {
        position: 'fixed' as const,
        top: 0,
        left: 0,
        right: 0,
        bottom: 0,
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
    },
    modalContent: {
        backgroundColor: 'white',
        padding: '20px',
        borderRadius: '5px',
        width: '80%',
        maxWidth: '500px',
    },
    closeButton: {
        marginTop: '10px',
        padding: '5px 10px',
        backgroundColor: '#f0f0f0',
        border: 'none',
        borderRadius: '3px',
        cursor: 'pointer',
    },
    button: {
        marginTop: '10px',
        padding: '10px 15px',
        backgroundColor: '#4CAF50',
        color: 'white',
        border: 'none',
        borderRadius: '3px',
        cursor: 'pointer',
        marginRight: '10px',
    },
    scannerContainer: {
        width: '100%',
        maxWidth: '300px',
        margin: '0 auto',
    },
    scanner: {
        width: '100%',
        height: 'auto',
    },
};

export default Mypagelist;

// interface Example {
//     id: string;
//     title: string;
//     description: string;
// }

// const ExamplePage: React.FC = () => {
//     const [examples, setExamples] = useState<Example[]>([]);

//     useEffect(() => {
//         axios.get('/api/examples')
//             .then(response => setExamples(response.data))
//             .catch(error => console.error(error));
//     }, []);

//     return (
//         <div>
//             <h1>Example Page</h1>
//             <ul>
//                 {examples.map(example => (
//                     <li key={example.id}>
//                         <h2>{example.title}</h2>
//                         <p>{example.description}</p>
//                     </li>
//                 ))}
//             </ul>
//         </div>
//     );
// }

// export default ExamplePage;
