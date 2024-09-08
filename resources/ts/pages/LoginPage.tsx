import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import {
    useToast,
    Flex,
    Button,
} from '@chakra-ui/react';

const LoginPage: React.FC = () => {
    const [error, setError] = useState<string | null>(null);
    const navigate = useNavigate();
    const toast = useToast();

    const [users, setUsers] = useState<any[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('/api/users')
            .then((response) => {
                console.log(response.data);
                setUsers(response.data);
                setLoading(false);
            })
            .catch((err) => {
                console.error(err); // エラー情報
                setError('ユーザーの取得に失敗しました');
                setLoading(false);
            });
    }, []);
    
    const [loginInput, setLogin] = useState({
        user_name: '',
        password: '',
        error_list: [],
    });

    const handleInput = (e:any) => {
        e.persist();
        setLogin({ ...loginInput, [e.target.name]: e.target.value });
    };

    const handleLogin = (e:any) => {
        e.preventDefault();

        const data = {
            user_name: loginInput.user_name,
            password: loginInput.password,
        };
        axios.get('/sanctum/csrf-cookie').then((response) => {
            axios.post(`api/login`, data).then((res) => {
                if (res.data.status === 200) {
                    localStorage.setItem('auth_token', res.data.token);
                    localStorage.setItem('auth_name', res.data.username);
                    toast({
                        title: 'ログイン成功',
                        status: 'success',
                        isClosable: true,
                    });
                    console.log('ログイン成功');
                    navigate('/');
                    // location.reload();
                } else if (res.data.status === 401) {
                    console.log('注意');
                    toast({
                        title: res.data.message,
                        status: 'error',
                        isClosable: true,
                    });
                } else {
                    setLogin({
                        ...loginInput,
                        error_list: res.data.validation_errors,
                    });
                }
            });
        });
    };
    
    return (
        // <div>
        //     <h2>ユーザーリスト</h2>
        //     <ul>
        //         {Array.isArray(users) && users.map(user => (
        //             <li key={user.id}>{user.name} ({user.email})</li>
        //         ))}
        //     </ul>
        // </div>
        <div style={styles.container}>
            <h2 style={styles.heading}>ログイン</h2>
            <form onSubmit={handleLogin} style={styles.form}>
                <div style={styles.inputGroup}>
                    <label style={styles.label}>ユーザー名</label>
                    <input
                        type="text"
                        name="user_name"
                        value={loginInput.user_name}
                        onChange={handleInput}
                        style={styles.input}
                    />
                </div>
                <div style={styles.inputGroup}>
                    <label style={styles.label}>パスワード</label>
                    <input
                        type="password"
                        name="password"
                        value={loginInput.password}
                        onChange={handleInput}
                        style={styles.input}
                    />
                </div>
                {error && <p style={styles.error}>{error}</p>}
                <button type="submit" style={styles.button}>ログイン</button>
                <div style={styles.registerLink}>
                    <p>アカウントをお持ちでないですか？</p>
                    <button onClick={() => navigate('/register')} style={styles.linkButton}>
                        新規登録ページへ
                    </button>
                </div>
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
    error: {
        color: 'red',
        marginBottom: '15px',
    },
    button: {
        padding: '10px',
        fontSize: '16px',
        backgroundColor: '#007bff',
        color: '#fff',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer',
        marginBottom: '10px',
    },
    registerLink: {
        display: 'flex',
        flexDirection: 'column' as const,
        alignItems: 'center',
        marginTop: '15px',
    },
    linkButton: {
        padding: '10px',
        fontSize: '16px',
        backgroundColor: '#007bff', // ログインボタンと同じ色
        color: '#fff',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer',
        marginTop: '5px',
    },
};

export default LoginPage;
