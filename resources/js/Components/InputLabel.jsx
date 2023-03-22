export default function InputLabel({ value, className = '', children, ...props }) {
    return (
        <label {...props} className={`mb-3` + className}>
            {value ? value : children}
        </label>
    );
}
