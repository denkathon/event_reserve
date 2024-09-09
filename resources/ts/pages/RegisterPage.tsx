import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { useToast } from '@chakra-ui/react'; 

const RegisterPage: React.FC = () => {
    const [userName, setUserName] = useState('');
    const [password, setPassword] = useState('');
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [phoneNumber, setPhoneNumber] = useState('');
    const navigate = useNavigate();
    const toast = useToast(); // トースト通知

    const handleRegister = async (event: React.FormEvent) => {
        event.preventDefault();

        try {
            // CSRFトークンの取得
            await axios.get('/sanctum/csrf-cookie');

            // レジスタのリクエスト
            const authResponse = await axios.post('/api/register', {
                user_name: userName,
                password: password,
                name: name,
                e_mail: email,
                phone_number: phoneNumber,
            });

            const authId = authResponse.data.auth_id;

            await axios.post('/api/users', {
                name: name,
                auth_id: authId,
                e_mail: email,
                phone_number: phoneNumber,
            });

            toast({
                title: 'アカウント登録が完了しました',
                status: 'success',
                isClosable: true,
            });

            navigate('/login'); // 登録後にログインページへリダイレクト
        } catch (error: any) {
            console.error('登録に失敗しました:', error.response ? error.response.data : error.message);
            toast({
                title: 'アカウント登録に失敗しました',
                description: error.response ? error.response.data.message : error.message,
                status: 'error',
                isClosable: true,
            });
        }
    };

    return (
        <div style={styles.container}>
            <h2 style={styles.heading}>アカウント登録</h2>
            <form onSubmit={handleRegister} style={styles.form}>
                <div style={styles.inputGroup}>
                    <label style={styles.label}>ユーザー名</label>
                    <input
                        type="text"
                        name="userName"
                        value={userName}
                        onChange={(e) => setUserName(e.target.value)}
                        style={styles.input}
                    />
                </div>
                <div style={styles.inputGroup}>
                    <label style={styles.label}>パスワード</label>
                    <input
                        type="password"
                        name="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        style={styles.input}
                    />
                </div>
                <div style={styles.inputGroup}>
                    <label style={styles.label}>名前</label>
                    <input
                        type="text"
                        name="name"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        style={styles.input}
                    />
                </div>
                <div style={styles.inputGroup}>
                    <label style={styles.label}>メールアドレス</label>
                    <input
                        type="email"
                        name="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        style={styles.input}
                    />
                </div>
                <div style={styles.inputGroup}>
                    <label style={styles.label}>電話番号</label>
                    <input
                        type="text"
                        name="phoneNumber"
                        value={phoneNumber}
                        onChange={(e) => setPhoneNumber(e.target.value)}
                        style={styles.input}
                    />
                </div>
                <button type="submit" style={styles.button}>登録</button>
            </form>
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
        fontSize: 'clamp(28px, 6vw, 48px)',
        fontWeight: 'bold' as const,
        color: '#333',
        marginBottom: 'clamp(10px, 2vw, 20px)',
    },
    form: {
        display: 'flex',
        flexDirection: 'column' as const,
        width: '100%',
        maxWidth: '400px',
    },
    inputGroup: {
        marginBottom: '15px',
    },
    label: {
        display: 'block',
        marginBottom: '5px',
    },
    input: {
        width: '100%',
        padding: '10px',
        fontSize: '16px',
        border: '1px solid #ddd',
        borderRadius: '4px',
    },
    button: {
        padding: '10px',
        fontSize: '16px',
        backgroundColor: '#007bff',
        color: '#fff',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer',
    },
};

export default RegisterPage;
